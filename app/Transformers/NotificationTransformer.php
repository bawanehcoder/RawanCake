<?php

namespace App\Transformers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Item;
use App\Models\Notification;
use App\Models\ShippingInfo;
use App\Models\Zones;
use Flugg\Responder\Transformers\Transformer;

class NotificationTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];

    public function transform(Notification $item)
    {
        return [
            'notifications'=>$latestNotifications = app()->make(\App\Interfaces\RepositoryInterface::class)->getLatestNotifications(getLogged())
        ];
    }
}
