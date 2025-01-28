<?php

namespace App\Services;

use Carbon\Carbon;

class UserPresenceService
{
    protected $user;

    public function __construct(){

        $this->user = getLogged();
    }
    public function registerUserPresence(){
        $this->updateUserLastSeen();
    }
    public function updateUserLastSeen(){
        //save last seen
        $this->user->LastSeenAt = Carbon::now();
    }

}
