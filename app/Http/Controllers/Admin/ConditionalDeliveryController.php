<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ConditionalDeliverieRequest;
use App\Http\Requests\Admin\ZonesRequest;
use App\Models\ConditionalDeliverie;
use App\Models\Item;
use App\Models\Region;
use App\Models\Zones;
use App\Repositories\ItemRepository;
use App\Repositories\ZoneRepository;
use App\Services\ConditionalDeliverieService;
use App\Services\ZonesService;
use Illuminate\Http\Request;
use DataTables;

class ConditionalDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!Admin()->can('conditional delivery view')){
            abort(401);
        }
        if ($request->ajax()) {
            $data = ConditionalDeliverie::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                  ->addColumn('title', function ($row) {
                                    return $row['title_'.strtolower(getLang())];
                                })
                ->addColumn('items', function ($row) {
                    $items = app()->make(ItemRepository::class)->itemsIds($row->items);
                    if (count($items)>0) {

                        return view('components.item-table', ['items' => $items,])->render();
                    }else {
                        return __("all");
                    }
                })
                ->addColumn('zone_ids', function ($row) {
                    $items=app()->make(ZoneRepository::class)->zoneIds($row->zone_ids);
                    if (count($items)>0) {
                         return view('components.zone-table', ['items' => $items,])->render();
                    }else{
                        return __("all");
                    }
                })

                ->addColumn('start_time', function ($row) {
                 return $row->start_time; })
                ->addColumn('end_time', function ($row) {
                    return $row->end_time; })
                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => true,
                        'showEditButton' => true,
                        'showDeleteButton' => true,

                    ])->render();
                })
                ->rawColumns(['action', 'items','zone_ids'])
                ->make(true);
        }

        return view('admin.conditional-deliveries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Admin()->can('conditional delivery create')){
            abort(401);
        }
        return view('admin.conditional-deliveries.create', ['zones' =>Zones::all(),'products'=>Item::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConditionalDeliverieRequest $request)
    {
        if(!Admin()->can('conditional delivery create')){
            abort(401);
        }
        $entity = ConditionalDeliverieService::storeFromRequest($request);
        return redirect()->route('dashboard.conditional-deliveries.edit', $entity)->with('message', __('created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ConditionalDeliverie $entity)
    {
        if(!Admin()->can('conditional delivery view')){
            abort(401);
        }
        return view('admin.conditional-deliveries.show',
            ['entity' => $entity,
                'zones' =>Zones::all(),
                'products'=>Item::all(),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConditionalDeliverie $entity)
    {
        if(!Admin()->can('conditional delivery edit')){
            abort(401);
        }
        return view('admin.conditional-deliveries.edit',
            ['entity' => $entity,
            'zones' =>Zones::all(),
            'products'=>Item::all(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConditionalDeliverieRequest $request, ConditionalDeliverie $entity)
    {
        if(!Admin()->can('conditional delivery edit')){
            abort(401);
        }
        $entity = ConditionalDeliverieService::updateFromRequest($entity, $request);

        return redirect()->route('dashboard.conditional-deliveries.edit', $entity)->with('message', __('update successfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConditionalDeliverie $entity)
    {
        if(!Admin()->can('conditional delivery delete')){
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
