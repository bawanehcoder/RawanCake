<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\ProductsRequest;

use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Photo;
use App\Models\UserFavorite;
use App\Repositories\GenralSettingRepository;

use App\Services\CartService;

use App\Services\MainCategoriesService;

use App\Services\UserFavoriteService;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class FavoritesController extends Controller
{


    public function index()
    {


$query= UserFavorite::where('UserID', getLogged()->id)->paginate(10);
        return responder()->success($query)->respond();


    }
    public function addToFavorite(Item $entity){




       if(getLogged()->hasFavorite($entity)){
           getLogged()->getFavorite($entity)->delete();
           $add_favorite=Response::HTTP_OK;
       }else{
           $add_favorite=UserFavoriteService::storeFromRequest($entity);
        }

        switch ($add_favorite) {
            case Response::HTTP_OK:
                return responder()->success(['hasFavorite'=>getLogged()->hasFavorite($entity)])->respond();
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                return responder()->error(500, __('something went wrong'))->respond();
        }
    }

}
