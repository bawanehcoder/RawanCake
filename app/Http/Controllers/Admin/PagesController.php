<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PagesRequest;
use App\Http\Requests\Admin\PagesUpdateRequest;
use App\Models\Item;
use App\Models\Page;
use App\Services\CategoriesService;
use App\Services\PagesService;
use Illuminate\Http\Request;
use DataTables;
class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Admin()->can('pages view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = Page::select('*');
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

        return view('admin.pages.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Admin()->can('pages create')) {
            abort(401);
        }
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PagesRequest $request)
    {
        if (!Admin()->can('pages create')) {
            abort(401);
        }
        PagesService::storeFromRequest($request);
        return redirect()->back()->with('message',  __('created successfully') );
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $entity)
    {
        if (!Admin()->can('pages view')) {
            abort(401);
        }
        return view('admin.pages.show',['entity' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $entity)
    {
        if (!Admin()->can('pages edit')) {
            abort(401);
        }
        return view('admin.pages.edit',['entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PagesUpdateRequest $request, Page $entity)
    {
        if (!Admin()->can('pages edit')) {
            abort(401);
        }
        PagesService::updateFromRequest($entity,$request);
        return redirect()->back()->with('message', __('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $entity)
    {
        if (!Admin()->can('pages delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
