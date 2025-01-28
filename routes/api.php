<?php

use App\Models\Order;
use App\Services\Payment\PaytabsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\MainCategoriesController;
use \App\Http\Controllers\Api\SubCategoriesController;
use \App\Http\Controllers\Api\ProductsController;
use \App\Http\Controllers\Api\ProductOptionsController;
use \App\Http\Controllers\Api\ProductSubOptionsController;
use \App\Http\Controllers\Api\PagesController;
use \App\Http\Controllers\Api\GeneralInfoController;
use \App\Http\Controllers\Api\BrancheController;
use \App\Http\Controllers\Api\ZonesController;
use \App\Http\Controllers\Api\GeneralSettingController;
use \App\Http\Controllers\Api\ApplicationGiftController;
use \App\Http\Controllers\Api\ContactController;
use \App\Http\Controllers\Api\NewsletterController;
use \App\Http\Controllers\Api\SliderController;
use \App\Http\Controllers\Api\MenuSliderController;
use \App\Http\Controllers\Api\Auth\RegisterController;
use \App\Http\Controllers\Api\Auth\LoginController;
use \App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ShippingInfoController;
use App\Http\Controllers\Api\FavoritesController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\userOccasionsController;
use App\Http\Controllers\Api\OccasionsController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\CouponsController;
use App\Http\Controllers\Api\UpdateTokenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.'], function () {
    //################## main-categories ##################
    Route::group(['as' => 'main-categories.', 'prefix' => 'main-categories'], function () {
        Route::controller(MainCategoriesController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });

    //########## Sub-categories #############
    Route::group(['as' => 'sub-categories.', 'prefix' => 'sub-categories'], function () {
        Route::controller(SubCategoriesController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });

    //########## Products #############
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::controller(ProductsController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/new-products', 'newProducts')->name('new_products');
            Route::get('/flash-sale', 'flashSale')->name('flash-sale');
            Route::get('/option-detil/{entity}', 'optionDetil')->name('option-detil');
            Route::get('/random-products', 'randomProducts')->name('random-products');


        });
    });
    //########## Basic Option-Products #############
    Route::group(['prefix' => 'product-options', 'as' => 'product-options.'], function () {
        Route::controller(ProductOptionsController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });
    //########## Sub Option-Products #############
    Route::group(['prefix' => 'product-sub-options', 'as' => 'product-sub-options.'], function () {
        Route::controller(ProductSubOptionsController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });

    //########## pages #############
    Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {
        Route::controller(PagesController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });
    //########## GeneralInfo #############
    Route::group(['prefix' => 'generalInfo', 'as' => 'generalInfo.'], function () {
        Route::controller(GeneralInfoController::class)->group(function () {
            Route::get('/', 'index')->name('index');

        });
    });

    //########## Branches #############
    Route::group(['prefix' => 'branches', 'as' => 'branches.'], function () {
        Route::controller(BrancheController::class)->group(function () {
            Route::get('/', 'index')->name('index');


        });
    });

    //########## zones Options #############
    Route::group(['prefix' => 'zones', 'as' => 'zones.'], function () {
        Route::controller(ZonesController::class)->group(function () {
            Route::get('/', 'index')->name('index');

        });
    });
    //########## general Settings #############
    Route::group(['prefix' => 'general-setting', 'as' => 'general-setting.',], function () {
        Route::controller(GeneralSettingController::class)->group(function () {
            Route::get('/', 'index')->name('index');

        });
    });

    //########## application gifts #############
    Route::group(['prefix' => 'application-gifts', 'as' => 'application-gifts.',], function () {
        Route::controller(ApplicationGiftController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });

    //########## ContactNotification #############
    Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
        Route::controller(ContactController::class)->group(function () {
            //  Route::get('index', 'index')->name('index');
            Route::post('send_message', 'store')->name('send_message');
            // Route::get('show/{entity}', 'show')->name('show');
        });
    });

    //########## newsletters #############
    Route::group(['prefix' => 'newsletters', 'as' => 'newsletters.'], function () {
        Route::controller(NewsletterController::class)->group(function () {
            Route::post('subscription', 'store')->name('subscription');
            Route::post('unsubscription', 'destroy')->name('unsubscription');
        });
    });

    //########## Slider #############
    Route::group(['prefix' => 'sliders', 'as' => 'sliders.', 'middleware' => ['throttle:1000,1']], function () {
        Route::controller(SliderController::class)->group(function () {
            Route::get('/', 'index')->name('index');

        });
    });

    //##########Menu Slider #############
    Route::group(['prefix' => 'menu-sliders', 'as' => 'menu-sliders.', 'middleware' => ['throttle:100,1']], function () {
        Route::controller(MenuSliderController::class)->group(function () {
            Route::get('/', 'index')->name('index');

        });
    });

    //########## Register #############
    Route::group(['prefix' => 'register', 'as' => 'register.', 'middleware' => ['throttle:100,1']], function () {
        Route::controller(RegisterController::class)->group(function () {
            Route::post('/', 'register')->name('register');
        });
    });

    //########## Register #############
    Route::group(['prefix' => 'login', 'as' => 'login.', 'middleware' => ['throttle:100,1']], function () {
        Route::controller(LoginController::class)->group(function () {
            Route::post('/defult', 'login')->name('login');
            Route::post('/social', 'socialLogin')->name('socialLogin');
        });
    });

    //########## User #############
    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['throttle:100,1']], function () {
        Route::controller(UserController::class)->group(function () {
            //logout
            Route::get('/logout', 'logout')->name('logout');
            //who am i
            Route::get('who-am-i', 'whoAmI');

            Route::group(['middleware' => ['loggedIn']], function () {
                //change passwordd
                Route::post('change-password', 'changePassword');
                //change avatar
                Route::post('update-avatar', 'updateAvatar');
                Route::post('complete-profile', 'completeMyProfile')->name('complete_profile');
                Route::post('delete-account', 'delete')->name('delete');
            });

        });
    });


    //##########    Cart #############
    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {

        Route::controller(CartController::class)->group(function () {
            Route::post('/addtocart/{entity}', 'addToCart')->name('addtocart');
            Route::post('/index', 'index')->name('view_cart');
            Route::post('/update-amount', 'updateAmount')->name('updateAmount');
            Route::post('delete/{entity}', 'destroy')->name('delete');

            // Route::group(['middleware' => ['loggedIn']], function () {
            //     Route::post('/addtocart/{entity}', 'addToCart')->name('addtocart');
            //     Route::get('/index', 'index')->name('view_cart');
            //     Route::post('/update-amount', 'updateAmount')->name('updateAmount');
            //     Route::post('delete/{entity}', 'destroy')->name('delete');
            // });
        });
    });

    Route::group(['prefix' => 'cartg', 'as' => 'cart.'], function () {

        Route::controller(CartController::class)->group(function () {
            // Route::post('/addtocart/{entity}', 'addToCart')->name('addtocart');
            // Route::get('/index', 'index')->name('view_cart');
            // Route::post('/update-amount', 'updateAmount')->name('updateAmount');
            // Route::post('delete/{entity}', 'destroy')->name('delete');

            Route::group(['middleware' => ['auth:sanctum']], function () {
                Route::post('/addtocart/{entity}', 'addToCart')->name('addtocart');
                Route::get('/index', 'index')->name('view_cart');
                Route::post('/update-amount', 'updateAmount')->name('updateAmount');
                Route::post('delete/{entity}', 'destroy')->name('delete');
            });
        });
    });


    //##########    shipping-info #############
    Route::group(['prefix' => 'shipping_info', 'as' => 'shipping_info.'], function () {
        Route::controller(ShippingInfoController::class)->group(function () {
            Route::group(['middleware' => ['loggedIn']], function () {
                Route::get('/index', 'index')->name('index');
                Route::post('/store', 'store')->name('save');
                Route::post('delete/{entity}', 'destroy')->name('delete');
            });
        });
    });




    // //reset password
    Route::post('forgot-password', [ResetPasswordController::class, 'forgot']);
    Route::post('reset-password', [ResetPasswordController::class, 'reset']);

    //##########  payment   #############
    Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
        Route::controller(PaymentController::class)->group(function () {
            Route::post('pay', 'redirectToPaymentGateway')->name('redirect_to_payment_gateway')->middleware('auth:sanctum');
            Route::post('webhook/{entity}', 'handleWebhook')->name('webhook');

        });
    });

    //##########    favorites #############
    Route::group(['prefix' => 'favorites', 'as' => 'favorites.'], function () {
        Route::controller(FavoritesController::class)->group(function () {
            Route::group(['middleware' => ['loggedIn', 'throttle:40,1']], function () {
                Route::get('/', 'index')->name('index');
                Route::post('/addtofavorite/{entity}', 'addToFavorite')->name('favorites.addtofavorite');
            });
        });
    });

    //##########    rating #############
    Route::group(['prefix' => 'rating', 'as' => 'rating.'], function () {
        Route::controller(RatingController::class)->group(function () {
            Route::group(['middleware' => ['loggedIn', 'throttle:100,1']], function () {
                Route::post('/addtorate/{entity}', 'AddToRate')->name('addtorate');
            });
        });
    });
    //##########    order #############
    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::controller(OrderController::class)->group(function () {
            Route::group(['middleware' => ['loggedIn', 'throttle:100,1']], function () {
                Route::get('/show/{entity}', 'show')->name('show');
                Route::get('/', 'index')->name('index');

            });
        });
    });

    //########## Notification #############
    Route::group(['prefix' => 'notifications', 'as' => 'notifications.', 'middleware' => ['loggedIn']], function () {
        Route::controller(NotificationController::class)->group(function () {
            //list notifications
            Route::get('index', 'index')->name('index');
            //get latest unread notifications in html format, (used in ajax interval fetches)
            Route::get('get-latest-unread-interval', 'getLatestUnreadNotifications')->name('get_latest_unread_notifications_in_html');
            //mark all notifications as read
            Route::get('mark-all-as-read', 'markAllAsRead')->name('mark_all_as_read');
        });
    });

    //########## User Occasion #############
    Route::group(['prefix' => 'user_occasions', 'as' => 'user_occasions.', 'middleware' => ['loggedIn']], function () {
        Route::controller(userOccasionsController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/categories', 'categories')->name('categories');
            Route::post('/update/{entity}', 'update')->name('update');
            Route::post('/store', 'store')->name('store');
            Route::post('delete/{entity}', 'destroy')->name('delete');
        });
    });

    //################## occasions ##################
    Route::group(['as' => 'occasions.', 'prefix' => 'occasions', 'middleware' => ['throttle:40,30']], function () {
        Route::controller(OccasionsController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });


    //########## Coupons #############
    Route::group(['prefix' => 'coupons', 'as' => 'coupons.', 'middleware' => ['loggedIn', 'throttle:40,30']], function () {
        Route::controller(CouponsController::class)->group(function () {
            Route::post('/check', 'check')->name('check');
        });
    });

    //########## UpdateTokenController #############
    Route::group(['prefix' => 'updateToken', 'as' => 'updateToken.', 'middleware' => ['loggedIn', 'throttle:200,30']], function () {
        Route::controller(UpdateTokenController::class)->group(function () {
            Route::post('/update', 'update')->name('update');
        });
    });



});

Route::group(['as' => 'api.'], function () {

});


Route::post('payment/callback', function (Request $request) {
    try {
        
        // sleep(5);
        
        \Log::info($request->all());

        $transactionReference = $request['transaction_reference'];

        \Log::info("Transaction Reference: " . $transactionReference);
        
        $plugin = new PaytabsService();
        $data = [
            "tran_ref"=> $request['transaction_reference']
        ];
        $response = $plugin->send_api_request('payment/query', $data, 'POST');
        // dd($response);
        \Log::info($response);

        $order = Order::where('cart_id', $response['cart_id'])->first();
        \Log::info($order);

        $order->PaymentNo = $response['tran_ref'];
        $order->PaymentData = $response['payment_result'];
        $order->PaymentStatus = $response['payment_result']['response_status'];
        if ($response['payment_result']['response_message'] == 'Authorised') {
            $order->Status = 'waiting';
        }

        $order->save();


        return response()->json(status: 200);
    } catch (Exception $ex) {
        \Log::error($ex->getMessage());
    }
    
});