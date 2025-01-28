<?php

namespace App\Providers;

use App\Repositories\ContactRepository;
use App\Repositories\MainCategoriesRepository;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\App;

class SiteServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
     //  App::booted(function() {
            view()->composer('*', function ($view) {
                $SiteData = $this->getViewSharableData();
                $view->with('main_categories', $SiteData['main_categories']);
            });
       // });
    }
    public function getViewSharableData(){
        return once(function (){
            return [
                'main_categories' => app()->make(MainCategoriesRepository::class)->get(),

            ];
        });
    }

}
