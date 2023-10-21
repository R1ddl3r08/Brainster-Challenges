<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AccountActivated;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationEmail;

class SendAccountActivation
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
        Mail::to($event->user->email)->send(new ActivationEmail($event->activationUrl));
    }
}
