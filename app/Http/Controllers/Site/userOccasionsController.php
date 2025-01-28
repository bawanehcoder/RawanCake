<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\ProductsRequest;

use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Http\Requests\Site\UserOccasionRequest;
use App\Models\CategoriesOccasion;
use App\Models\Category;
use App\Models\Item;
use App\Models\Photo;
use App\Models\UserFavorite;
use App\Models\UserOccasion;
use App\Repositories\GenralSettingRepository;

use App\Services\CartService;

use App\Services\MainCategoriesService;

use App\Services\UserFavoriteService;
use App\Services\UserOccasionService;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Http\Response;


class userOccasionsController extends Controller
{


    public function index()
    {
        $userOccasion = getLogged()->userOccasion()->get();
        return view('site.user-occasion.index', ['occasions' => $userOccasion]);

    }

    public function create()
    {
        $categories=CategoriesOccasion::all();

        return view('site.user-occasion.create',['categories'=>$categories]);
    }

    public function edit(UserOccasion $entity)
    {
        $categories=CategoriesOccasion::all();
        return view('site.user-occasion.edit', ['entity' => $entity,'categories'=>$categories]);
    }

    public function update(UserOccasionRequest $request, UserOccasion $entity)
    {
        UserOccasionService::updateFromRequest($entity, $request);
        return redirect()->back()->with('message', __('updated successfully'));
    }

    public function store(UserOccasionRequest $request)
    {
        UserOccasionService::storeFromRequest($request);
        return redirect()->back()->with('message', __('create successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,UserOccasion $entity)
    {
        $entity->delete();

        if($request->ajax() || $request->wantsJson()) {

            return \View::make('site.myprofile.user-occasion-widget')->render();
        }


        return redirect()->back()->with('message', __('deleted successfully'));

    }

}
