<?php

namespace App\Services\Payment;

class PaytabsConfig
{
    public static function getBaseApiUrl()
    {
        return config('payment.paytabs.mode') == 'production' ? config('payment.paytabs.production.base_url') : config('payment.paytabs.sandbox.base_url');
    }

    public static function getApiToken()
    {
        return config('payment.paytabs.mode') == 'production' ? config('payment.paytabs.production.api_token') : config('payment.paytabs.sandbox.api_token');
    }

    public static function getProfileID()
    {
        return config('payment.paytabs.mode') == 'production' ? config('payment.paytabs.production.profileID') : config('payment.paytabs.sandbox.profileID');
    }

    public static function getSuccessfulTransactionCallbackUrl()
    {

        return route(config('payment.paytabs.successful_callback_route_name'));
    }

    public static function getFailedTransactionCallbackUrl()
    {
        return route(config('payment.paytabs.failed_callback_route_name'));
    }

}
