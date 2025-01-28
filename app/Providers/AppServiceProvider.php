<?php


namespace App\Providers;


use App\Interfaces\RepositoryInterface;
use App\Repositories\BasicOptionRepository;
use App\Repositories\ItemRepository;
use App\Repositories\MainCategoriesRepository;
use App\Repositories\NotificationRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Spatie\MediaLibrary\MediaCollections\FileAdder;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void

    {
        foreach (glob(app()->basePath() . '/Helpers/*.php') as $filename) {
            require_once($filename);
        }
        //custom blade directives
        Blade::directive('langucw', function ($expression) {
            return "<?php if(\Config::get('app.locale') == 'ar'){echo __($expression);}else{echo ucwords(__($expression));};?>";
        });
        Blade::directive('langucf', function ($expression) {
            return "<?php if(\Config::get('app.locale') == 'ar'){echo __($expression);}else{echo ucfirst(__($expression));};?>";
        });
        Blade::directive('languc', function ($expression) {
            return "<?php if(\Config::get('app.locale') == 'ar'){echo __($expression);}else{echo strtoupper(__($expression));};?>";
        });

        //use bootstrap paginator instead of default tailwind
        Paginator::useBootstrap();
    }

    public function boot(): void

    {

        //register macros (method to get temporary path to file)
        if (class_exists(FileAdder::class)) {
            FileAdder::macro('getPathToFile', function () {
                return $this->pathToFile;
            });

            FileAdder::macro('getDiskName', function () {
                return $this->diskName;
            });

            FileAdder::macro('getFileName', function () {
                return $this->fileName;
            });

        }

        $this->app->bind(RepositoryInterface::class, MainCategoriesRepository::class);
        $this->app->bind(RepositoryInterface::class, BasicOptionRepository::class);
        $this->app->bind(RepositoryInterface::class, ItemRepository::class);
        $this->app->bind(RepositoryInterface::class, NotificationRepository::class);

        if (App::isProduction()) {
            URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);

    }

}

