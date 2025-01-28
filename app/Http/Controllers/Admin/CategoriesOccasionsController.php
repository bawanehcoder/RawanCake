<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoriesOccasionRequest;
use App\Http\Requests\Admin\OccasionRequest;
use App\Http\Requests\Admin\UpdateCategoriesOccasionRequest;
use App\Http\Requests\Admin\ZonesRequest;
use App\Models\CategoriesOccasion;
use App\Models\Occasion;
use App\Models\Region;
use App\Models\Zones;
use App\Services\CategoriesOccasionService;
use App\Services\OccasionService;
use App\Services\ZonesService;
use Illuminate\Http\Request;
use DataTables;
class CategoriesOccasionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!Admin()->can('categories occasions view')){
            abort(401);
        }
        if ($request->ajax()) {
            $data = CategoriesOccasion::query();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return '<a target="_blank" href="'.$row->getFirstMediaUrl('categories_occasion', 'large').'"><img class="img-thumbnail" src="' . $row->getFirstMediaUrl('categories_occasion', 'small') . '"></a>';
                })
                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => false,
                        'showEditButton' => true,
                        'showDeleteButton' => true,
                    ])->render();
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }

        return view('admin.categories_occasions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Admin()->can('categories occasions create')){
            abort(401);
        }
        return view('admin.categories_occasions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesOccasionRequest $request)
    {
        if(!Admin()->can('categories occasions create')){
            abort(401);
        }
        $entity= CategoriesOccasionService::storeFromRequest($request);
        return redirect()->route('dashboard.categories_occasions.create',$entity)->with('message', __('created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoriesOccasion $entity)
    {
        if(!Admin()->can('categories occasions view')){
            abort(401);
        }
        $deliveries=json_decode($entity->delivery) ;
        return view('admin.categories_occasions.show',['entity' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoriesOccasion $entity)
    {
        if(!Admin()->can('categories occasions edit')){
            abort(401);
        }
        return view('admin.categories_occasions.edit',['entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesOccasionRequest $request, CategoriesOccasion $entity)
    {
        if(!Admin()->can('categories occasions edit')){
            abort(401);
        }
        $entity= CategoriesOccasionService::updateFromRequest($entity,$request);
        return redirect()->route('dashboard.categories_occasions.edit', $entity)->with('message', __('update successfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriesOccasion $entity)
    {
        if(!Admin()->can('categories occasions delete')){
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
