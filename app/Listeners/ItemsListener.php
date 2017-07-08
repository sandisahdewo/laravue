<?php

namespace App\Listeners;

use App\Events\ItemsEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ItemsListener
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
     * @param  ItemsEvent  $event
     * @return void
     */
    public function handle(ItemsEvent $event)
    {
        dd($event);
    }
}
