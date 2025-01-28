<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainCategoriesRequest;
use App\Http\Requests\Admin\SubCategoriesRequest;
use App\Http\Requests\Admin\UpdateMainCategoriesRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Services\CategoriesService;
use App\Services\MainCategoriesService;
use App\Services\MediaService;
use Illuminate\Http\Request;
use App\Services\B2UrlGenerator;
use DataTables;

class SubCategoriesController extends Controller
{
    public function index(Request $request)
    {
        if (!Admin()->can('sub categories view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = Category::where('CatID','>',0);
           if($request->filled('mainCategories')){
               $data=$data->where('CatID',$request->mainCategories);
           }
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('image', function ($row) {
                    return '<img src="' . $row->getFirstMediaUrl('categories', 'small') . '">';
                })
                ->addColumn('Visible', function ($row) {
                    return '<span class="badge badge-linesuccess">' . __($row->getStatusName('Visible')) . '</span>';

                })
                ->addColumn('CatID', function ($row) {
                    $main_cat=$row->mainCategory($row->CatID);
                    return $main_cat->Name."|".$main_cat->NameEN;
                })
                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => false,
                        'showEditButton' => false,
                        'showDeleteButton' => false,
                    ])->render();
                })
                ->rawColumns(['action', 'image', 'Visible'])
                ->make(true);
        }

        return view('admin.sub-categories.index',['main_categories'=>CategoriesService::getMainCategories()]);
    }

    public function create()
    {
        if (!Admin()->can('sub categories create')) {
            abort(401);
        }
        return view('admin.sub-categories.create',['main_categories'=>CategoriesService::getMainCategories()]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoriesRequest $request)
    {
        if (!Admin()->can('sub categories create')) {
            abort(401);
        }
        CategoriesService::storeFromRequest($request);
        return redirect()->back()->with('message', __('created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $entity)
    {
        if (!Admin()->can('sub categories edit')) {
            abort(401);
        }
        return view('admin.sub-categories.edit', ['main_categories'=>CategoriesService::getMainCategories(),'entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMainCategoriesRequest $request, Category $entity)
    {
        if (!Admin()->can('sub categories edit')) {
            abort(401);
        }
        CategoriesService::updateFromRequest($entity,$request);
        return redirect()->back()->with('message', __('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Category $entity)
    {
        if (!Admin()->can('sub categories delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

}
