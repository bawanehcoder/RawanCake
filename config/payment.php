<?php
return [
    'paytabs' => [

        'mode' => 'production',
        'sandbox' => [
            'profileID' => '147094',
            'api_token' => 'SRJ9TJRKBL-JJLD2T29GN-MZLHRJ9GMK',
            'base_url' => 'https://secure-jordan.paytabs.com/',
        ],
        'production' => [
            'profileID' => '62027',
            'api_token' => 'SDJN9LT229-JB6LRRMH9R-GKHMBN6TZK',
            'base_url' => 'https://secure-jordan.paytabs.com/',
        ],
        'successful_callback_route_name' => 'payment.paytabs.result',
        'failed_callback_route_name' => 'payment.paytabs.result2',
    ]
];


