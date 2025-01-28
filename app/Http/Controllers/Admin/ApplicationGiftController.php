<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApplicationGiftRequest;
use App\Models\ApplicationGift;
use App\Models\Item;
use App\Services\ApplicationGiftService;
use Illuminate\Http\Request;
use DataTables;
class ApplicationGiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!Admin()->can('application gifts view')){
            abort(401);
        }
        if ($request->ajax()) {
            $data = ApplicationGift::select('*');
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => false,
                        'showEditButton' => true,
                        'showDeleteButton' => false,

                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.application-gift.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApplicationGift $entity)
    {
        if(!Admin()->can('application gifts edit')){
            abort(401);
        }
        return view('admin.application-gift.edit',['entity'=>$entity,'products'=>Item::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApplicationGiftRequest $request,ApplicationGift $entity)
    {
        if(!Admin()->can('application gifts update')){
            abort(401);
        }
        $entity=ApplicationGiftService::updateFromRequest($entity,$request);
        return redirect()->route('dashboard.application-gifts.edit',$entity)->with('message', __('updated successfully'));


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
