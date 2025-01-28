<?php

namespace App\Listeners;

use App\Services\ActionPointService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReferralListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $point=ActionPointService::getActionPoint('invitation_points');
        $event->user->chargePoints($point, 'member_referral');
    }
}
