<?php

namespace App\Listeners;

use App\Events\LoginHistory;
use App\Models\UserLoginHistory;
use Illuminate\Support\Carbon;

class StoreloginHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param LoginHistory $event
     * @return void
     */
    public function handle(LoginHistory $event)
    {
        $userHistory = new UserLoginHistory();

        $userHistory->email       = $event->user->email;
        $userHistory->login_time  = Carbon::now();
        $userHistory->timestamps  = false;
        $userHistory->save();
    }
}
