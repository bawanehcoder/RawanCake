<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\DuplicateElementException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OffersRequest;
use App\Http\Requests\Admin\ProductsRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;


use App\Models\Item;
use App\Models\Offer;

use App\Services\CategoriesService;
use App\Services\OfferService;
use App\Services\ProductsService;
use Illuminate\Http\Request;
use DataTables;

class OffersController extends Controller
{
    public function index(Request $request)
    {
        if (!Admin()->can('offers view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = Offer::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('ItemID', function ($row) {
                    if ($row->item) {
                        return $row->item->Name;
                    }
                })
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

        return view('admin.offers.index');
    }

    public function create()
    {
        if (!Admin()->can('offers create')) {
            abort(401);
        }
        return view('admin.offers.create', ['products' => Item::all()]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(OffersRequest $request)
    {
        if (!Admin()->can('offers create')) {
            abort(401);
        }
        $offers = OfferService::storeFromRequest($request);

        switch ($offers) {
            case 'created':
                return redirect()->back()->with('message', __('created successfully'));
            case 'element is duplicate':
                return redirect()->back()->withErrors(__('element is duplicate'));
            default :
                return redirect()->back()->withErrors(__('something went wrong'));
        }

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $entity)
    {
        if (!Admin()->can('offers edit')) {
            abort(401);
        }
        return view('admin.offers.edit', ['products' => Item::all(), 'entity' => $entity]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(OffersRequest $request, Offer $entity)
    {
        if (!Admin()->can('offers edit')) {
            abort(401);
        }
        $entity = OfferService::updateFromRequest($entity, $request);
        return $entity ? redirect()->route('dashboard.offers.edit', $entity)->with('message', __('created successfully')) : redirect()->back()->withErrors(__('something went wrong'));


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Offer $entity)
    {
        if (!Admin()->can('offers delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
