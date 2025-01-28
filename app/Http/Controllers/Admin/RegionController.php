<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\OperatorRequest;
use App\Http\Requests\Admin\RegionRequest;
use App\Http\Requests\Admin\UpdateMainCategoriesRequest;
use App\Interfaces\RepositoryInterface;
use App\Models\Category;
use App\Models\Operator;

use App\Models\Region;
use App\Services\CategoriesService;


use App\Services\OperatorService;
use App\Services\RegionService;
use Illuminate\Http\Request;

use DataTables;

class RegionController extends Controller
{


    public function index(Request $request)
    {
        if (!Admin()->can('regions view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = Region::select('*');
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => false,
                        'showEditButton' => true,
                        'showDeleteButton' => true,
                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.region.index');
    }

    public function create()
    {
        if (!Admin()->can('regions create')) {
            abort(401);
        }
        return view('admin.region.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RegionRequest $request)
    {
        if (!Admin()->can('regions create')) {
            abort(401);
        }
        RegionService::storeFromRequest($request);
        return redirect()->back()->with('message', __('created successfully'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $entity)
    {
        if (!Admin()->can('regions edit')) {
            abort(401);
        }
        return view('admin.region.edit', ['entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegionRequest $request, Region $entity)
    {
        if (!Admin()->can('regions edit')) {
            abort(401);
        }
        RegionService::updateFromRequest($entity, $request);
        return redirect()->back()->with('message', __('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $entity)
    {
        if (!Admin()->can('regions delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

}
