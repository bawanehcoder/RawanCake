<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZonesRequest;
use App\Models\Region;
use App\Models\Zones;
use App\Services\ZonesService;
use Illuminate\Http\Request;
use DataTables;
class ZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Admin()->can('delivery locations view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = Zones::select('*');
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => true,
                        'showEditButton' => true,
                        'showDeleteButton' => true,

                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.zones.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Admin()->can('delivery locations create')) {
            abort(401);
        }
        return view('admin.zones.create',['regions'=>Region::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ZonesRequest $request)
    {
        if (!Admin()->can('delivery locations create')) {
            abort(401);
        }
        $entity= ZonesService::storeFromRequest($request);
        return redirect()->route('dashboard.zones.edit',$entity)->with('message', __('created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Zones $entity)
    {
        if (!Admin()->can('delivery locations view')) {
            abort(401);
        }
        $deliveries=json_decode($entity->delivery) ;
        return view('admin.zones.show',['entity' => $entity,'deliveries'=>$deliveries]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zones $entity)
    {
        if (!Admin()->can('delivery locations edit')) {
            abort(401);
        }
       $deliveries=json_decode($entity->delivery) ;
        $regions=Region::all();
        return view('admin.zones.edit',['entity' => $entity,'deliveries'=>$deliveries,'regions'=>$regions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ZonesRequest $request, Zones $entity)
    {
        if (!Admin()->can('delivery locations edit')) {
            abort(401);
        }
        $entity= ZonesService::updateFromRequest($entity,$request);
        return redirect()->route('dashboard.zones.edit',$entity)->with('message', __('update successfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zones $entity)
    {
        if (!Admin()->can('delivery locations delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
