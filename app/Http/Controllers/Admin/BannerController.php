<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Http\Requests\Admin\BannerRequest;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Banner;
use App\Models\Slide;
use App\Services\BannerService;
use App\Services\SliderService;
use Illuminate\Http\Request;
use DataTables;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        if (!Admin()->can('slider view')) {
            abort(401);
        }
        if ($request->ajax()) {
            $data = Banner::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return '<a href="'.$row->getFirstMediaUrl('banner', 'large').'" target="_blank"><img width="100px" height="80px" src="' . $row->getFirstMediaUrl('banner', 'small') . '"></a>';
                })
                ->addColumn('url', function ($row) {
                    if($row->url!=null){
                         return '<a href="'.$row->url.'" target="_blank">'.$row->url.'</a>';
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
                ->rawColumns(['action', 'image','url'])
                ->make(true);
        }

        return view('admin.banner.index');
    }

    public function create()
    {
        if (!Admin()->can('slider create')) {
            abort(401);
        }
        return view('admin.banner.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        if (!Admin()->can('slider create')) {
            abort(401);
        }

        BannerService::storeFromRequest($request);
        return redirect()->back()->with('message', __('created successfully'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $entity)
    {
        if (!Admin()->can('slider edit')) {
            abort(401);
        }
        return view('admin.banner.edit', ['entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, Banner $entity)
    {
        if (!Admin()->can('slider edit')) {
            abort(401);
        }
        BannerService::updateFromRequest($entity,$request);
        return redirect()->back()->with('message', __('updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Banner $entity)
    {
        if (!Admin()->can('slider delete')) {
            abort(401);
        }
        $entity->delete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

}
