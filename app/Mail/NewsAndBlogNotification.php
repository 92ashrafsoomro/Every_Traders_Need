<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsAndBlogNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $messageContent;
    public $settings;

    public function __construct($title, $messageContent ,$settings )
    {
        $this->title = $title;
        $this->messageContent = $messageContent;
        $this->settings = $settings;
    }

    public function build()
    {
        return $this->subject($this->title)
                    ->view('emails.news_and_blog')
                    ->with([
                        'title' => $this->title,
                        'messageContent' => $this->messageContent,
                        'settings' => $this->settings
                    ]);
    }
}
