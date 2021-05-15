<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\SendEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMail implements ShouldQueue
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        //寄信給註冊成功使用者，送入佇列
        $job = new SendEmail('welcome', $event->user, '歡迎註冊論壇！', $event->user['email']);
        dispatch($job);
    }
}
