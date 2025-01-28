<?php

namespace App\Http\Controllers\Api;

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
        $query = getLogged()->userOccasion()->get();
        return responder()->success($query)->respond();
    }
      public function categories()
        {
            $query = CategoriesOccasion::all();
            return responder()->success($query)->respond();
        }
    public function update(UserOccasionRequest $request, UserOccasion $entity)
    {
        $entity= UserOccasionService::updateFromRequest($entity, $request);
        return responder()->success($entity)->respond();
    }

    public function store(UserOccasionRequest $request)
    {
        $entity= UserOccasionService::storeFromRequest($request);
        return responder()->success($entity)->respond();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserOccasion $entity)
    {
        $entity->delete();
        return responder()->success()->respond();
    }

}
