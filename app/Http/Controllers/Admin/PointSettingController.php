<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\ActionPointRequest;
use App\Models\ActionPoint;
use Illuminate\Http\Request;
use DataTables;
class PointSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Admin()->can('point settings view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = ActionPoint::select('*');
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => false,
                        'showEditButton' => true,
                        'showDeleteButton' => false,

                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.action-point.index');
    }







    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActionPoint $entity)
    {
        if (!Admin()->can('point settings edit')) {
            abort(401);
        }
        return view('admin.action-point.edit',['entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActionPointRequest $request, ActionPoint $entity)
    {
        if (!Admin()->can('point settings edit')) {
            abort(401);
        }
        $entity->point=$request->point;
        $entity->save();
      //  return view('admin.action-point.edit', ['entity' => $entity]);
       return redirect()->route('dashboard.point-settings.edit',$entity)->with('message', __('update successfully'));

    }

}
