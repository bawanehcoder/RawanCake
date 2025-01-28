<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Site\ProfuleUserRequest;
use App\Http\Requests\Site\UpdateUserRequest;
use App\Models\User;

use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

use DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {

        if (!Admin()->can('users view')) {
            abort(401);
        }
        if ($request->ajax()) {

            $data = User::query();
            $data = $data->with('points');
            #Apply filters:
            if (!empty($request->filter_by)) {
                switch ($request->filter_by) {
                    case 'online':
                        $data->online();
                        break;
                    case 'genderMale':
                        $data->genderMale();
                        break;
                    case 'genderFemale':
                        $data->genderFemale();
                        break;
                    case 'loggingFacebook':
                        $data->loggingFacebook();
                        break;
                    case 'loggingGoogle':
                        $data->loggingGoogle();
                        break;
                    case 'loggingSite':
                        $data->loggingSite();
                        break;
                    case 'single':
                        $data->Single();
                        break;
                    case 'married':
                        $data->married();
                        break;


                }
            }
            //date range filter
            if ($request->filter_by == 'birthday') {
                if (!empty($request->from_date) || !empty($request->to_date)) {
                    $data->whereMonth('BirthDate', '>=', Carbon::parse($request->from_date)->month)->whereDay('BirthDate', '>=', Carbon::parse($request->from_date)->day);
                    $data->whereMonth('BirthDate', '<=', Carbon::parse($request->to_date)->month)->whereDay('BirthDate', '<=', Carbon::parse($request->to_date)->day);
                }
            } else {
                if (!empty($request->from_date) || !empty($request->to_date)) {
                    $data->whereBetween('created_at', [$request->from_date ? Carbon::parse($request->from_date)->hour(0)->minute(0)->second(0) : '0000-00-00', $request->to_date ? Carbon::parse($request->to_date)->hour(23)->minute(59)->second(59) : '9999-12-30']);
                }
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('avatar', function ($row) {
                    return view('components.avatar', [
                        'entity' => $row,
                    ])->render();
                })
                ->addColumn('LastSeenAt', function ($row) {
                    if ($row->isOnline()) {
                        return __('online');
                    }
                    return !empty($row->LastSeenAt) ? Carbon::parse($row->LastSeenAt)->diffForHumans() : '';
                })
                ->addColumn('balance', function ($row) {
                    return $row->totalPoints();
                })
                ->addColumn('points_value', function ($row) {
                    return $row->convertPointstoMoney($row->totalPoints());
                })
                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => true,
                        'showEditButton' => true,
                        'showDeleteButton' => false,
                    ])->render();
                })
                ->setRowClass(function ($row) {

                    return $row->isOnline() ? 'bg-success-subtle' : '';
                })
                ->rawColumns(['action', 'avatar'])
                ->make(true);
        }

        return view('admin.users.index', ['filter_by', $request->filter_by]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $entity)
    {
        if (!Admin()->can('users view')) {
            abort(401);
        }
        return view('admin.users.show', ['user' => $entity]);
    }

    /**
     * Display the specified resource.
     */
    public function edit(User $entity)
    {
        if (!Admin()->can('users view')) {
            abort(401);
        }
        return view('admin.users.edit', ['user' => $entity]);
    }

    public function update(UpdateUserRequest $request, User $entity)
    {
        if (!Admin()->can('users edit')) {
            abort(401);
        }
        UserService::updateFromRequest($entity, $request);
        return redirect()->back()->with('message', __('updated successfully'));
    }
}
