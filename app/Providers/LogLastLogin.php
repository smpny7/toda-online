<?php

namespace App\Providers;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogLastLogin
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
     * @param  Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        $event->user->updated_at = now();
        $event->user->save();
    }
}
