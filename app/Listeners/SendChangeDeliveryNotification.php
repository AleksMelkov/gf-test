<?php

namespace App\Listeners;

use App\Events\DeliveryDelivered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChangeDeliveryNotification implements ShouldQueue
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
    public function handle(DeliveryDelivered $event): void
    {
        // отправляем уведомление пользователю
    }
}
