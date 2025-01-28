<?php

namespace App\Http\Controllers\Api;

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
        $query = Branche::select('*');
        return responder()->success($query)->respond();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchesRequest $request)
    {


    }

    /**
     * Display the specified resource.
     */
    public function show(Branche $entity)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branche $entity)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchesRequest $request, Branche $entity)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
