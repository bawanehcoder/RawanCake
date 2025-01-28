<?php

namespace App\Http\Controllers;

use App\Models\Scroll;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ScrollController extends Controller
{
    public function index(Request $request)
    {
        if (!Admin()->can('main categories view')) {
            abort(401);
        }

        if ($request->ajax()) {
            $data = Scroll::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return '<div class="productimgname"><a href="javascript:void(0);" class="product-img stock-img"><img src="' . asset($row->image) . '"></a></div>';
                })

                ->addColumn('action', function ($row) {
                    $row->blob = 'scroll';
                    return view('components.table_crud', [
                        'entity' => $row,
                        'showViewButton' => false,
                        'showEditButton' => true,
                        'showDeleteButton' => true,

                    ])->render();
                })
                ->rawColumns(['action', 'image', 'Visible'])
                ->make(true);
        }
        return view('admin.scroll.index');
    }

    public function create()
    {
        if (!Admin()->can('main categories create')) {
            abort(401);
        }
        return view('admin.scroll.create');
    }

    public function store(Request $request)
    {
        $scroll = new Scroll();
        $scroll->name_ar = $request->name_ar;
        $scroll->name_en = $request->name_en;
        $scroll->content_ar = $request->content_ar;
        $scroll->content_en = $request->content_en;
        $scroll->image = $request->image;
        $scroll->save();

        return redirect()->route('dashboard.scroll.index')->with('success', 'Scroll added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scroll $entity)
    {
        if(!Admin()->can('main categories edit')){
            abort(401);
        }
        return view('admin.scroll.edit', ['entity' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Scroll $entity)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scroll $entity)
    {
        $entity->name_ar = $request->name_ar;
        $entity->name_en = $request->name_en;
        $entity->content_ar = $request->content_ar;
        $entity->content_en = $request->content_en;
        $entity->image = $request->image;
        $entity->save();

        return redirect()->route('dashboard.scroll.index')->with('success', 'Scroll added successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Scroll $entity)
    {
        if(!Admin()->can('main categories delete')){
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }
}
