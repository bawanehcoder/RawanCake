<?php

namespace App\Providers;

use App\Repositories\ContactRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\App;

class BaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        // App::booted(function() {
        //     view()->composer('*', function ($view) {
        //         if (!isLogged()) {
        //             return false;
        //         }
        //         $controlpanelData = $this->getViewSharableData();
        //         $data=[
        //             'messageCount'=>$controlpanelData['messageCount'],
        //             'countOfOnlineUsers'=>$controlpanelData['countOfOnlineUsers'],
        //             'countOfUsers'=>$controlpanelData['countOfUsers'],
        //         ];
        //         $view->with($data);
        //     });
        // });
    }
    public function getViewSharableData(){
        return once(function (){
            return [
                'messageCount' => app()->make(ContactRepository::class)->getCountOfUnreadMessages(),
                'countOfOnlineUsers' => app()->make(UserRepository::class)->getCountOfOnlineUsers(),
                'countOfUsers' => app()->make(UserRepository::class)->getCountOfUsers(),


            ];
        });
    }

}
