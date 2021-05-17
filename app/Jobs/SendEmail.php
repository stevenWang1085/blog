<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mailData;
    public $title;
    public $mailTo;
    public $view;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($view, $mail_data, $title, $mail_to)
    {
        $this->view = $view;
        $this->mailData = $mail_data;
        $this->title = $title;
        $this->mailTo = $mail_to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send($this->view, $this->mailData, function($message) {
            $message->to($this->mailTo)->subject($this->title);
        });
    }
}
