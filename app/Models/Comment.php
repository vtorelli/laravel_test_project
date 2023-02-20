<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
      'content', 'author_name', 'author_email', 'article_id'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function emailVerification()
    {
        return $this->hasOne(EmailVerification::class);
    }
}
