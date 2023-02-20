<?php

namespace App\Models;
use App\Models\Comment;
use App\Mail\CommentVerificationMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'token', 'comment_id'];

    public function comments()
    {
        return $this->belongsTo(Comment::class);
    }

    public function sendEmailVerificationNotification()
    {
        $verificationLink = url("/email/verify/{$this->id}");
        foreach ($this->comments as $comment) {
            $authorName = $comment->author_name;
            Mail::to($comment->author_email)->send(new CommentVerificationMail($verificationLink, $authorName));
        }
    }

}
