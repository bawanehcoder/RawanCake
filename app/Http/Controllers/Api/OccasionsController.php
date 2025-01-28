<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\ProductsRequest;

use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Http\Requests\Site\UserOccasionRequest;
use App\Models\CategoriesOccasion;
use App\Models\Category;
use App\Models\Item;
use App\Models\Occasion;
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
use Illuminate\Support\Carbon;

class OccasionsController extends Controller
{
    public function index()
    {


        $query =  Occasion::where('date', Carbon::now()->format('Y-m-d'))->get();

        return responder()->success($query)->respond();
    }



}
