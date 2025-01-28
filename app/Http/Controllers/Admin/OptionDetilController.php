<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateOptionDetilRequest;
use App\Models\Item;
use App\Models\ItemOption;
use App\Models\OptionDetil;
use App\Models\SubOption;
use App\Services\OptionDetilService;
use Illuminate\Http\Request;

class OptionDetilController extends Controller
{
    public function create(Item $entity)
    {
        if (!Admin()->can('option products view')) {
            abort(401);
        }
        return view('admin.products.create-options', ['options' => ItemOption::all(), 'entity' => $entity]);
    }

    public function edit(OptionDetil $entity)
    {
        if (!Admin()->can('option products edit')) {
            abort(401);
        }
        return view('admin.products.edit-options', ['options' => ItemOption::all(), 'entity' => $entity]);
    }

    public function update(UpdateOptionDetilRequest $request, OptionDetil $entity)
    {
        if (!Admin()->can('option products edit')) {
            abort(401);
        }
        OptionDetilService::updateFromRequest($entity, $request);
        return redirect()->back()->with('message', __('updated successfully'));
    }

    public function store(UpdateOptionDetilRequest $request, Item $entity)
    {
        if (!Admin()->can('option products create')) {
            abort(401);
        }
        OptionDetilService::storeFromRequest($entity, $request);
        return redirect()->back()->with('message', __('created successfully'));
    }

    public function destroy(OptionDetil $entity)
    {
        if (!Admin()->can('option products delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

}
