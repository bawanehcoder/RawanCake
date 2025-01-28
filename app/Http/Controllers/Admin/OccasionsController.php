<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OccasionRequest;
use App\Http\Requests\Admin\ZonesRequest;
use App\Models\Occasion;
use App\Models\Region;
use App\Models\Zones;
use App\Services\OccasionService;
use App\Services\ZonesService;
use Illuminate\Http\Request;
use DataTables;
class OccasionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Admin()->can('occasions view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = Occasion::query();
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

        return view('admin.occasions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Admin()->can('occasions create')) {
            abort(401);
        }
        return view('admin.occasions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OccasionRequest $request)
    {
        if (!Admin()->can('occasions create')) {
            abort(401);
        }
        $entity= OccasionService::storeFromRequest($request);
        return redirect()->route('dashboard.occasions.create',$entity)->with('message', __('created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Zones $entity)
    {
        if (!Admin()->can('occasions view')) {
            abort(401);
        }
        $deliveries=json_decode($entity->delivery) ;
        return view('admin.occasions.show',['entity' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Occasion $entity)
    {
        if (!Admin()->can('occasions edit')) {
            abort(401);
        }
        return view('admin.occasions.edit',['entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OccasionRequest $request, Occasion $entity)
    {
        if (!Admin()->can('occasions edit')) {
            abort(401);
        }
        $entity= OccasionService::updateFromRequest($entity,$request);
        return redirect()->route('dashboard.occasions.edit', $entity)->with('message', __('update successfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Occasion $entity)
    {
        if (!Admin()->can('occasions delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
