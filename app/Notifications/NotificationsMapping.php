<?php
use  \App\Notifications\OccasionNotify;
use \App\Notifications\Formatter\OccasionNotificationFormatter;
use \App\Models\Occasion;
use \App\Notifications\UserOccationNotify;
use \App\Notifications\Formatter\UserOccasionNotificationFormatter;
use \App\Models\UserOccasion;

return [
   OccasionNotify::class=>[
       'formatterClass' => OccasionNotificationFormatter::class,
       'params' => [
           [
               'fieldName' => 'entity_id',
               'className' => Occasion::class,
               'passToConstructorAs' => 'occasion',
               'with' => [''],
           ]
       ],
       'redirect_url' => '/',
       'sender_name' => __(config('app.name')),
       'sender_avatar' => '/site/assets/images/logo.png',
       'is_from_admin' => 1,

   ],
   UserOccationNotify::class=>[
        'formatterClass' => UserOccasionNotificationFormatter::class,
        'params' => [
            [
                'fieldName' => 'entity_id',
                'className' => UserOccasion::class,
                'passToConstructorAs' => 'occasion',
                'with' => [''],
            ]
        ],
        'redirect_url' => '/',
        'sender_name' => __(config('app.name')),
        'sender_avatar' => '/site/assets/images/logo.png',
        'is_from_admin' => 1,

    ]


];
