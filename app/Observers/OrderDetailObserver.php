<?php

namespace App\Observers;

use App\Models\OrderDetail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OrderDetailObserver
{
    /**
     * Handle the OrderDetail "created" event.
     */
    public function created(OrderDetail $orderDetail): void
    {
        //
    }

    /**
     * Handle the OrderDetail "updated" event.
     */
    public function updated(OrderDetail $orderDetail): void
    {
        //
    }

    /**
     * Handle the OrderDetail "deleted" event.
     */
    public function deleted(OrderDetail $orderDetail): void
    {

        try {
            if( $orderDetail->getFirstMediaUrl('images','large')){
                $orderDetail->deletePreservingMedia();
            }


        }catch (\Exception $ex){

        }

    }

    /**
     * Handle the OrderDetail "restored" event.
     */
    public function restored(OrderDetail $orderDetail): void
    {
        //
    }

    /**
     * Handle the OrderDetail "force deleted" event.
     */
    public function forceDeleted(OrderDetail $orderDetail): void
    {
        //
    }
}
