<?php

namespace App\Http\Controllers;

use App\Repositories\GenralSettingRepository;
use App\Repositories\ItemRepository;
use App\Repositories\MainCategoriesRepository;
use App\Services\CartService;
use Artesaos\SEOTools\SEOMeta;
use Artesaos\SEOTools\SEOTools;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(public ItemRepository $productRepo,public GenralSettingRepository $genralSettingRepository){
        $this->productRepo = $productRepo;

    }


    public function index(Request $request)
    {

        \SEO::setTitle(__('home'))
            ->setDescription(__('rwan cacke - home'));


        CartService::login($request);
        return view('site.welcome');

    }

    public function logout(Request $request)
    {
        \Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

}
