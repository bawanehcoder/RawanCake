<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\OperatorRequest;
use App\Http\Requests\Admin\UpdateMainCategoriesRequest;
use App\Interfaces\RepositoryInterface;
use App\Models\Category;
use App\Models\Operator;

use App\Services\CategoriesService;


use App\Services\OperatorService;
use Illuminate\Http\Request;

use DataTables;

class OperatorController extends Controller
{
    public function __construct(RepositoryInterface $repository)
    {
        $this->mainCategoriesRepository = $repository;
    }

    public function index(Request $request)
    {
        if (!Admin()->can('operators view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = Operator::select('*');
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
        return view('admin.operator.index');
    }

    public function create()
    {
        if (!Admin()->can('operators create')) {
            abort(401);
        }
        return view('admin.operator.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(OperatorRequest $request)
    {
        if (!Admin()->can('operators create')) {
            abort(401);
        }
        OperatorService::storeFromRequest($request);
        return redirect()->back()->with('message', __('created successfully'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Operator $entity)
    {
        if (!Admin()->can('operators edit')) {
            abort(401);
        }
        return view('admin.operator.edit', ['entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OperatorRequest $request, Operator $entity)
    {
        if (!Admin()->can('operators edit')) {
            abort(401);
        }
        OperatorService::updateFromRequest($entity, $request);
        return redirect()->back()->with('message', __('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Operator $entity)
    {
        if (!Admin()->can('operators delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

}
