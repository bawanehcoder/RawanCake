<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchesRequest;
use App\Models\Branche;
use App\Services\BranchesService;
use Illuminate\Http\Request;
use DataTables;

class BrancheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!Admin()->can('branches view')){
            abort(401);
        }
        if ($request->ajax()) {
            $data = Branche::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Map', function ($row) {
                    return '<iframe width="180" height="135" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="' . $row->Map . '"> </iframe>';
                })
                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => true,
                        'showEditButton' => true,
                        'showDeleteButton' => true,
                    ])->render();
                })
                ->rawColumns(['action', 'Map'])
                ->make(true);
        }

        return view('admin.branches.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Admin()->can('branches create')){
            abort(401);
        }
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchesRequest $request)
    {
        if(!Admin()->can('branches create')){
            abort(401);
        }
        $entity = BranchesService::storeFromRequest($request);
        return redirect()->back()->with('message', __('created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Branche $entity)
    {
        if(!Admin()->can('branches view')){
            abort(401);
        }
        return view('admin.branches.show',['entity'=>$entity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branche $entity)
    {
        if(!Admin()->can('branches edit')){
            abort(401);
        }
        return view('admin.branches.edit',['entity'=>$entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchesRequest $request, Branche $entity)
    {
        if(!Admin()->can('branches edit')){
            abort(401);
        }
        $entity = BranchesService::updateFromRequest($entity,$request);
        return redirect()->back()->with('message', __('update successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branche $entity)
    {
        if(!Admin()->can('branches delete')){
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
