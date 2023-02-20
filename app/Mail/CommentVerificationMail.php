<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationLink;
    public $authorName;

    public function __construct($verificationLink, $authorName)
    {
        $this->verificationLink = $verificationLink;
        $this->authorName = $authorName;
    }

    public function build()
    {
        return $this->markdown('comment_verification')
                    ->subject('Verify your comment on our blog');
    }
}
