<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainCategoriesRequest;
use App\Http\Requests\Admin\UpdateMainCategoriesRequest;
use App\Interfaces\RepositoryInterface;
use App\Models\Category;
use App\Models\Photo;
use App\Services\CategoriesService;
use Illuminate\Http\Request;
use DataTables;

class MainCategoriesController extends Controller
{
    public function __construct(RepositoryInterface $repository)
    {
        $this->mainCategoriesRepository = $repository;
    }

    public function index(Request $request)
    {

        if(!Admin()->can('main categories view')){
            abort(401);
        }

        if ($request->ajax()) {
            $data = Category::where('CatID', 0);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return '<div class="productimgname"><a href="javascript:void(0);" class="product-img stock-img"><img src="' . $row->getFirstMediaUrl('categories', 'small') . '"></a></div>';
                })
                ->addColumn('Visible', function ($row) {
                    return '<span class="badge badge-linesuccess">' . __($row->getStatusName('Visible')) . '</span>';
                })
                ->addColumn('action', function ($row) {
                    return view('components.view_button', [
                        'entity' => $row
                    ])->render();
                })
                ->rawColumns(['action', 'image', 'Visible'])
                ->make(true);
        }
        return view('admin.main-categories.index');
    }

    public function create()
    {
        if(!Admin()->can('main categories create')){
            abort(401);
        }
        return view('admin.main-categories.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MainCategoriesRequest $request)
    {
        CategoriesService::storeFromRequest($request);
        return redirect()->back()->with('message', __('created successfully'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $entity)
    {
        if(!Admin()->can('main categories edit')){
            abort(401);
        }
        return view('admin.main-categories.edit', ['entity' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Category $entity)
    {
        if(!Admin()->can('main categories edit')){
            abort(401);
        }
        return view('admin.main-categories.show', ['entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMainCategoriesRequest $request, Category $entity)
    {
        if(!Admin()->can('main categories edit')){
            abort(401);
        }
        CategoriesService::updateFromRequest($entity, $request);
        return redirect()->back()->with('message', __('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Category $entity)
    {
        if(!Admin()->can('main categories delete')){
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

}
