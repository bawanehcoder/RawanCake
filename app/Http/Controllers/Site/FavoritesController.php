<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

use App\Models\Item;
use App\Models\UserFavorite;
use App\Repositories\GenralSettingRepository;

use App\Services\UserFavoriteService;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Http\Response;


class FavoritesController extends Controller
{
    public function __construct(public GenralSettingRepository $genralSettingRepository)
    {
    }

    public function index(Request $request)
    {
        $favorites = getLogged()->userFavorite()->paginate(config('core.setting.perPage'));
        if ($request->ajax() || $request->wantsJson()) {
            return \View::make('site.favorites.index-block', [
                'favorites' => $favorites,
                'genralSetting' => $this->genralSettingRepository,
                'page' => $request->page ?? 0
            ])->render();
        }

        return view('site.favorites.index',
            [
                'favorites' => $favorites,
                'genralSetting' => $this->genralSettingRepository,
                'page' => $request->page ?? 0
            ]
        );
    }

    public function addToFavorite(Item $entity)
    {

        if (getLogged()->hasFavorite($entity)) {
            getLogged()->getFavorite($entity)->delete();
            $add_favorite = Response::HTTP_OK;
        } else {
            $add_favorite = UserFavoriteService::storeFromRequest($entity);
        }

        switch ($add_favorite) {
            case Response::HTTP_OK:
                return responder()->success(['hasFavorite' => getLogged()->hasFavorite($entity)])->respond();
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                return responder()->error(500, __('something went wrong'))->respond();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserFavorite $entity)
    {

    }

}
