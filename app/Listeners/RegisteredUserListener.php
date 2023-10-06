<?php

namespace App\Listeners;

use App\Events\RegisteredUserEvent;
use App\Models\User\User;
use App\Notifications\RegisteredUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisteredUserListener
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(RegisteredUserEvent $event): void
    {
        $user = $event->user;
        if ($user instanceof User) {
            $user->notify(new RegisteredUserNotification($event->password));
        }
    }
}
