<?php


use App\Exports\InvoicesExport;
use App\Exports\UsersExport;
use App\Http\Controllers\ScrollController;
use App\Models\Order;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LanguageController;
use \App\Http\Controllers\Site\SocialLoginController;
use \App\Http\Controllers\Site\PageController;
use \App\Http\Controllers\Site\ContactUsController;
use \App\Http\Controllers\Site\OurBranchesController;
use \App\Http\Controllers\Site\NewsletterController;
use \App\Http\Controllers\Site\ProductsController;
use \App\Http\Controllers\Site\CartController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\Site\ShippingInfoController;
use \App\Http\Controllers\Site\PaymentController;
use \App\Http\Controllers\Site\OrderController;
use \App\Http\Controllers\Site\FavoritesController;
use \App\Http\Controllers\Site\RatingController;
use \App\Http\Controllers\Site\CouponsController;
use \App\Http\Controllers\Site\NotificationController;
use \App\Http\Controllers\Site\userOccasionsController;
use \App\Http\Controllers\Site\ReferralController;
use \App\Http\Controllers\Site\MyprofileController;
use Maatwebsite\Excel\Facades\Excel;



Route::post('/test2', function () {
    $order = \App\Models\OrderDetail::where('id', 169)->first();

    $images = \App\Services\MediaService::addMultipleMediaFromRequest($order, 'images', 'test', getLogged());
    dd($images);
});

Route::get('/test', function () {
    //generate referral code
    // getLogged()->generateNewReferralCode();

    //    $referral = Referral::create([
//        'referrer_id' => 19,
//        'registerer_id' => 80,
//    ]);
    dd(\App\Services\BranchesService::getFirstBrache());


});


Route::get('shop', function () {
    return view('site.cat.index');
})->name('mainshop');


//###############   welcome ###############
Route::get('/', [HomeController::class, 'index'])->name('home');

//###############   detect referrals ###############
Route::get('ref/{code}', [ReferralController::class, 'detectReferral'])->name('detect_referral');


//###############   Other SocialLogin routes ###############
Route::group(['as' => 'social_login.', 'prefix' => 'socialLogin',], function () {
    Route::controller(SocialLoginController::class)->group(function () {
        //guest only rotues
        Route::group(['middleware' => ['guest']], function () {
            //redirect to OAuth authentication page
            Route::get('login', 'redirectToProvider')->name('redirect_to_provider');
            //handle OAuth callback
            Route::get('login-by-provider/callback', 'handleProviderCallback')->name('call_back');
        });
    });
});



######################################


#solve the problem of twitter
Route::get('/socialLogin/login-by-provider/twitter/callback', function () {
    $oauth_token = \Request()->oauth_token;
    $oauth_verifier = \Request()->oauth_verifier;
    return redirect()->route('frontend.social_login.call_back', [
        'guard' => 'user',
        'provider' => 'twitter',
        'oauth_token' => $oauth_token,
        'oauth_verifier' => $oauth_verifier,
    ]);
})->middleware('guest');





//###############   Other Page routes   ###############
Route::group(['as' => 'page.', 'prefix' => 'page'], function () {
    Route::get('{routeName}', [PageController::class, 'show'])->name('show');
});
//###############   contact us  ###############
Route::group(['as' => 'contact_us.', 'prefix' => 'contact_us'], function () {
    Route::get('/', [ContactUsController::class, 'show'])->name('show');
    Route::post('/send', [ContactUsController::class, 'sendMessageToAdmin'])->name('send')->middleware(['throttle:6,10']);

});

//##########    newsletters #############
Route::group(['prefix' => 'newsletters', 'as' => 'newsletters.'], function () {
    Route::controller(NewsletterController::class)->group(function () {
        Route::post('/subscription', 'store')->name('subscription')->middleware(['throttle:5,10']);
        //        Route::post('unsubscription', 'destroy')->name('unsubscription');
    });
});

//###############   Our-Branches    ###############
Route::group(['as' => 'our_branches.', 'prefix' => 'our_branches'], function () {
    Route::get('/', [OurBranchesController::class, 'show'])->name('show');

});

//##########    Cart #############
Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
    Route::controller(CartController::class)->group(function () {
        Route::post('/addtocart/{entity}', 'addToCart')->name('cart.addToCart');
        Route::get('/index', 'index')->name('view_cart');
        //        Route::get('/shipping-info', 'shippingInfo')->name('shipping_info');
        Route::post('delete/{entity}', 'destroy')->name('delete');
        Route::post('media', 'storeMedia')->name('storeMedia');

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
//##########    products #############
Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::controller(ProductsController::class)->group(function () {
        Route::get('index/{entity?}/{sub?}', 'index')->name('index');
        Route::get('show/{entity}', 'show')->name('show');
        Route::get('quick-show/{entity}', 'quickShow')->name('quick-show');

        Route::group(['middleware' => ['loggedIn', 'throttle:10,1']], function () {

        });
    });
});

//##########    favorites #############
Route::group(['prefix' => 'favorites', 'as' => 'favorites.'], function () {
    Route::controller(FavoritesController::class)->group(function () {
        Route::group(['middleware' => ['loggedIn', 'throttle:20,1']], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/addtofavorite/{entity}', 'addToFavorite')->name('addToFavorite');
        });
    });
});


//##########    payment #############
Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
    Route::controller(PaymentController::class)->group(function () {
        Route::post('paytabs/result', 'redirectToPaymentGatewayError')->name('paytabs.result');
        Route::get('paytabs/result', 'redirectToPaymentGatewayError2')->name('paytabs.result2');
        Route::group(['middleware' => ['loggedIn', 'throttle:50,1']], function () {
            Route::get('/pay/{entity}', 'showPaymentForm')->name('show_payment_form');
            Route::get('/pay', 'showPaymentForm')->name('show_payment_form2');
            //redirect to choosed payment gateway
            Route::post('pay', 'redirectToPaymentGateway')->name('redirect_to_payment_gateway');
        });
    });
});

Route::get('rejected', function () {

    return view('rejected' );
})->name('alaa.rejected');
//##########    order #############
Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    Route::controller(OrderController::class)->group(function () {
        Route::group(['middleware' => ['loggedIn', 'throttle:50,1']], function () {
            Route::get('/show/{entity}', 'show')->name('show');
            Route::get('/', 'index')->name('index');

        });
    });
});


//##########    rating #############
Route::group(['prefix' => 'rating', 'as' => 'rating.'], function () {
    Route::controller(RatingController::class)->group(function () {
        Route::group(['middleware' => ['loggedIn', 'throttle:10,1']], function () {
            Route::post('/addtorate/{entity}', 'AddToRate')->name('addtorate');


        });
    });
});

//########## Coupons #############
Route::group(['prefix' => 'coupons', 'as' => 'coupons.', 'middleware' => ['loggedIn', 'throttle:40,30']], function () {
    Route::controller(CouponsController::class)->group(function () {
        Route::post('/check', 'check')->name('check');


    });
});

//########## Notification #############
Route::group(['prefix' => 'notifications', 'as' => 'notifications.', 'middleware' => ['loggedIn']], function () {
    Route::controller(NotificationController::class)->group(function () {
        //list notifications
        Route::get('', 'index')->name('index');
        //get latest unread notifications in html format, (used in ajax interval fetches)
        Route::get('get-latest-unread-interval', 'getLatestUnreadNotificationsInHtml')->name('get_latest_unread_notifications_in_html');
        //mark all notifications as read
        Route::get('mark-all-as-read', 'markAllAsRead')->name('mark_all_as_read');

    });
});

//########## User Occasion #############
Route::group(['prefix' => 'user_occasions', 'as' => 'user_occasions.', 'middleware' => ['loggedIn']], function () {
    Route::controller(userOccasionsController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/edit/{entity}', 'edit')->name('edit');
        Route::post('/update/{entity}', 'update')->name('update');
        Route::post('/store', 'store')->name('store');
        Route::get('/create', 'create')->name('create');
        Route::post('delete/{entity}', 'destroy')->name('delete');


    });
});
//########## User Occasion #############
Route::group(['prefix' => 'referral', 'as' => 'referral.', 'middleware' => ['loggedIn']], function () {
    Route::controller(ReferralController::class)->group(function () {
        Route::get('', 'index')->name('index');
    });
});

//########## Myprofile #############
Route::group(['prefix' => 'myprofile', 'as' => 'myprofile.', 'middleware' => ['loggedIn']], function () {
    Route::controller(MyprofileController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('update', 'completeMyProfile')->name('update');
    });
});


Auth::routes();

Route::post('logout', [HomeController::class, 'logout'])->name('logout');
//########## change app language ##########
Route::get('app/change-language', ['lang' => LanguageController::class, 'changeLanguage'])->name('app.change_language')->middleware(['throttle:100,1']);

//########## scroll #############





Route::get('cc', function () {
    Artisan::call('optimize:clear');
});


Route::get('ie/{entity}', function (Order $entity) {
    // dd($entity);
    // return Excel::download(new UsersExport, 'users.xlsx');
    // return Excel::download(new InvoicesExport($entity), 'invoices.xlsx');

    return view('admin.orders.pdf-order', [
        'entity' => $entity
    ]);
})->name('alaa.pdf');

Route::get('tn', function () {
    $recipient = auth()->user();
    Notification::make()
        ->title('Saved successfully')
        ->sendToDatabase($recipient);
})->middleware('auth');



Route::get('/orders-print/{order}/print', function ($order) {
    return view('orders', compact('order'));
})->name('orders.prints');