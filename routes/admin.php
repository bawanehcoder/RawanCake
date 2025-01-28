<?php

use App\Http\Controllers\ScrollController;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use \App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\Controller;
use \App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use \App\Http\Controllers\Admin\MainCategoriesController;
use \App\Http\Controllers\Admin\SubCategoriesController;
use \App\Http\Controllers\Admin\ProductsController;
use \App\Http\Controllers\Admin\ProductOptionsController;
use \App\Http\Controllers\Admin\ProductSubOptionsController;
use \App\Http\Controllers\Admin\OptionDetilController;
use \App\Http\Controllers\Admin\OffersController;
use \App\Http\Controllers\Admin\DiscountsController;
use \App\Http\Controllers\Admin\PagesController;
use \App\Http\Controllers\Admin\GeneralInfoController;
use \App\Http\Controllers\Admin\BrancheController;
use \App\Http\Controllers\Admin\ZonesController;
use \App\Http\Controllers\Admin\ZoneOptionsController;
use \App\Http\Controllers\Admin\GeneralSettingController;
use \App\Http\Controllers\Admin\PointSettingController;
use \App\Http\Controllers\Admin\ApplicationGiftController;
use \App\Http\Controllers\Admin\CouponsController;
use \App\Http\Controllers\Admin\ContactController;
use \App\Http\Controllers\Admin\NewsletterController;
use \App\Http\Controllers\Admin\SliderController;
use \App\Http\Controllers\Admin\MenuSliderController;
use \App\Http\Controllers\Admin\OrdersController;
use \App\Http\Controllers\Admin\OperatorController;
use \App\Http\Controllers\Admin\RegionController;
use \App\Http\Controllers\Admin\UsersController;
use \App\Http\Controllers\Admin\OccasionsController;
use \App\Http\Controllers\Admin\ConditionalDeliveryController;
use \App\Http\Controllers\Admin\CategoriesOccasionsController;
use \App\Http\Controllers\Admin\RoleAndPermissionController;
use \App\Http\Controllers\Admin\UserAdminController;
use \App\Http\Controllers\Admin\SalesReportController;
use \App\Http\Controllers\Admin\SupportTicketController;
use \App\Http\Controllers\Admin\BannerController;
use \App\Http\Controllers\Admin\ProductReportController;

//##########  dashboard group ##########


Route::prefix('dashboard')->name('dashboard.')->group(function () {


    // ########## Home Dashboard ##########
    Route::get('/', [Controller::class, 'index'])->name('index')->middleware('adminLoggdIn');


    // ########## Reset Password ##########
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
    });
    // ########## login ##########
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('login', 'checkLogin')->name('check');
        Route::any('logout', 'logout')->name('logout')->middleware(['adminLoggdIn']);
    });


    //########## main-categories #############
    Route::group(['prefix' => 'main-categories', 'as' => 'main-categories.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(MainCategoriesController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::get('show/{entity}', 'show')->name('show');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });

    });



    //########## main-categories #############
    Route::group(['prefix' => 'main-categories', 'as' => 'main-categories.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(MainCategoriesController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::get('show/{entity}', 'show')->name('show');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });

    });


    //########## scroll #############
    Route::group(['prefix' => 'scroll', 'as' => 'scroll.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(ScrollController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::get('show/{entity}', 'show')->name('show');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });

    });

    //########## Sub-categories #############
    Route::group(['prefix' => 'sub-categories', 'as' => 'sub-categories.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(SubCategoriesController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });
    //########## operator #############
    Route::group(['prefix' => 'operator', 'as' => 'operator.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(OperatorController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });

    //########## region #############
    Route::group(['prefix' => 'region', 'as' => 'region.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(RegionController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });

    //########## Products #############
    Route::group(['prefix' => 'products', 'as' => 'products.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(ProductsController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
            Route::get('options/{entity}', 'options')->name('options');
            Route::get('options-delete/{entity}', 'index')->name('options-delete');
        });
    });
    //########## products-options #############
    Route::group(['prefix' => 'products-options', 'as' => 'products-options.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(OptionDetilController::class)->group(function () {
            Route::get('create/{entity}', 'create')->name('create');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
            Route::post('store/{entity}', 'store')->name('store');
        });
    });
    //########## Basic Option-Products #############
    Route::group(['prefix' => 'product-options', 'as' => 'product-options.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(ProductOptionsController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });
    //########## Sub Option-Products #############
    Route::group(['prefix' => 'product-sub-options', 'as' => 'product-sub-options.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(ProductSubOptionsController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::get('get_subOption_by_parent/{entity}', 'getSubOptionByParent')->name('get_subOption_by_parent');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });


    //########## Offers-Products #############
    Route::group(['prefix' => 'offers', 'as' => 'offers.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(OffersController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });

    //########## discounts #############
    Route::group(['prefix' => 'discounts', 'as' => 'discounts.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(DiscountsController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });

    //########## pages #############
    Route::group(['prefix' => 'pages', 'as' => 'pages.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(PagesController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::get('show/{entity}', 'show')->name('show');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });

    //########## GeneralInfo #############
    Route::group(['prefix' => 'generalInfo', 'as' => 'generalInfo.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(GeneralInfoController::class)->group(function () {
            Route::get('edit', 'edit')->name('edit');
            Route::post('update/{entity?}', 'update')->name('update');

        });
    });
    //########## Branches #############
    Route::group(['prefix' => 'branches', 'as' => 'branches.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(BrancheController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::get('show/{entity}', 'show')->name('show');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');

        });
    });

    //########## zones #############
    Route::group(['prefix' => 'zones', 'as' => 'zones.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(ZonesController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::get('show/{entity}', 'show')->name('show');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');

        });
    });
    //########## conditional delivery #############
    Route::group(['prefix' => 'conditional-deliveries', 'as' => 'conditional-deliveries.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(ConditionalDeliveryController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::get('show/{entity}', 'show')->name('show');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');

        });
    });


    //########## zones Options #############
    Route::group(['prefix' => 'zone-options', 'as' => 'zone-options.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(ZoneOptionsController::class)->group(function () {
            Route::post('store/{entity}', 'store')->name('store');
            Route::post('show/{entity}', 'show')->name('show');
            Route::post('delete/{entity}', 'destroy')->name('delete');

        });
    });

    //########## general Settings #############
    Route::group(['prefix' => 'generalSetting', 'as' => 'generalSetting.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(GeneralSettingController::class)->group(function () {
            Route::get('edit', 'edit')->name('edit');
            Route::post('update/{entity?}', 'update')->name('update');

        });
    });
    //########## point settings #############
    Route::group(['prefix' => 'point-settings', 'as' => 'point-settings.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(PointSettingController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
        });
    });
    //########## application gifts #############
    Route::group(['prefix' => 'application-gifts', 'as' => 'application-gifts.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(ApplicationGiftController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
        });
    });
    //########## Coupons #############
    Route::group(['prefix' => 'coupons', 'as' => 'coupons.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(CouponsController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::get('show/{entity}', 'show')->name('show');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');

        });
    });
    //########## ContactNotification #############
    Route::group(['prefix' => 'contacts', 'as' => 'contacts.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(ContactController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::get('show/{entity}', 'show')->name('show');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });
    //########## newsletters #############
    Route::group(['prefix' => 'newsletters', 'as' => 'newsletters.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(NewsletterController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::post('unsubscription', 'destroy')->name('unsubscription');
            Route::get('/export-newsletters', 'exportNewsletters')->name('export-newsletters')->middleware(['throttle:3,10']);
        });
    });

    //########## Slider #############
    Route::group(['prefix' => 'sliders', 'as' => 'sliders.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(SliderController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });
    //########## Banners #############
    Route::group(['prefix' => 'banner', 'as' => 'banner.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(BannerController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });


    //########## menu-slider #############
    Route::group(['prefix' => 'menu-sliders', 'as' => 'menu-sliders.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(MenuSliderController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });


    //########## Orders #############
    Route::group(['prefix' => 'orders', 'as' => 'orders.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(OrdersController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('show/{entity}', 'show')->name('show');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::get('change-delivery-type/{entity}', 'changeDeliveryType')->name('change-delivery-type');
            Route::get('change-zone/{entity}', 'changeZone')->name('change-zone');
            Route::post('change-phone2/{entity}', 'changePhone2')->name('change-phone2');
            Route::get('change-branch/{entity}', 'changeBranch')->name('change-branch');
            Route::post('delete-item/{entity}/{item}', 'deleteItem')->name('delete-item');
            Route::post('update-item/{entity}/{item}', 'updateItem')->name('update-item');
            Route::post('add-item-order/{entity}/{item}', 'addItemOrder')->name('add-item-order');
            Route::get('get-item/{entity}/{item}', 'getItem')->name('get-item');
            Route::get('order_action/{entity}', 'OrderAction')->name('order_action');
            Route::get('export-pdf/{entity}', 'exportPDF')->name('export-pdf');

        });
    });
    //########## Users #############
    Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(UsersController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('show/{entity}', 'show')->name('show');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
        });
    });
    //########## Occasions #############
    Route::group(['prefix' => 'occasions', 'as' => 'occasions.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(OccasionsController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });

    //########## Categories Occasions #############
    Route::group(['prefix' => 'categories_occasions', 'as' => 'categories_occasions.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(CategoriesOccasionsController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });

    //########## user-admin #############
    Route::group(['prefix' => 'user-admin', 'as' => 'user-admin.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(UserAdminController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('show/{entity}', 'show')->name('show');
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });
    //########## user-admin #############
    Route::group(['prefix' => 'user-admin-permission', 'as' => 'user-admin-permission.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(RoleAndPermissionController::class)->group(function () {
            Route::get('edit/{entity}', 'edit')->name('edit');
            Route::post('update/{entity}', 'update')->name('update');
            Route::get('show/{entity}', 'show')->name('show');

        });
    });

    //########## sales-report #############
    Route::group(['prefix' => 'sales-report', 'as' => 'sales-report.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(SalesReportController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('show/{entity}', 'show')->name('show');
            Route::get('/export-sales-report', 'exportSalesReport')->name('export-sales-report')->middleware(['throttle:10,10']);
        });
    });

    //########## product-report #############
    Route::group(['prefix' => 'product-report', 'as' => 'product-report.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(ProductReportController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('/export-sales-report', 'exportSalesReport')->name('export-sales-report')->middleware(['throttle:10,10']);
        });
    });


    //########## support-ticket #############
    Route::group(['prefix' => 'support-ticket', 'as' => 'support-ticket.', 'middleware' => ['adminLoggdIn']], function () {
        Route::controller(SupportTicketController::class)->group(function () {
            Route::get('index', 'index')->name('index');

        });
    });


});


//########## change app language ##########
Route::get('app/change-language', [LanguageController::class, 'changeLanguage'])->name('app.change_language')->middleware(['throttle:100,1']);

