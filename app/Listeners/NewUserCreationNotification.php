<?php

namespace App\Listeners;

use App\Jobs\ProcessCheckPassword;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewUserCreationNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        //if ($event->user instanceof Registered)
        dispatch(new ProcessCheckPassword(1));
        
    }
}
