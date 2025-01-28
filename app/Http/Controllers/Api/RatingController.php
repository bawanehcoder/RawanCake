<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\ProductsRequest;

use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Photo;
use App\Models\Rating;
use App\Models\UserFavorite;
use App\Repositories\GenralSettingRepository;

use App\Services\CartService;

use App\Services\MainCategoriesService;

use App\Services\RatingService;
use App\Services\UserFavoriteService;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Http\Response;


class RatingController extends Controller
{



    public function AddToRate(Request $request,Item $entity){

       if(getLogged()->hasRated($entity)){
           $add_rate=Response::HTTP_OK;
       }else{
            $add_rate=RatingService::storeFromRequest($request,$entity);
        }
        switch ($add_rate) {
            case Response::HTTP_OK:
                return responder()->success(['rating'=>$entity->getAvarg()])->respond();
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                return responder()->error(500, __('something went wrong'))->respond();
        }
    }
}
