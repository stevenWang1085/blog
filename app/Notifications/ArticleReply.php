<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class ArticleReply extends Notification implements ShouldQueue
{
    use Queueable;

    public $notify_to_user_id;
    public $notify_from_user_id;
    public $notify_type;
    public $notify_from_user_name;
    public $article_title;
    public $article_comment;
    public $article_id;
    public $time;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notify_data)
    {
        $this->notify_to_user_id = $notify_data['notify_to_user_id'];
        $this->notify_from_user_id = $notify_data['notify_from_user_id'];
        $this->notify_type = $notify_data['notify_type'];
        $this->notify_from_user_name = $notify_data['notify_from_user_name'];
        $this->article_title = $notify_data['article_title'];
        $this->article_id = $notify_data['article_id'];
        $this->article_comment = $notify_data['article_comment'] ?? null;
        $this->time = $notify_data['time'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'notify_from_user_id'   => $this->notify_from_user_id,
            'notify_to_user_id'     => $this->notify_to_user_id,
            'notify_type'           => $this->notify_type,
            'notify_from_user_name' => $this->notify_from_user_name,
            'article_title'         => $this->article_title,
            'article_comment'       => $this->article_comment,
            'article_id'            => $this->article_id,
            'time'                  => $this->time
        ];
    }

    public function failed (\Exception $exception)
    {
        $data = [
            'error_type'  => 'Notification',
            'error_msg'   => $exception->getMessage(),
        ];

        Mail::send('failed_job', $data, function($message) {
            $message->to('4a114019@stust.edu.tw')->subject('! Failed Job !');
        });
    }
}
