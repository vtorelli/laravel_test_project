<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Comment;
use App\Models\EmailVerification;
use App\Mail\CommentVerificationMail;


class CommentController extends Controller
{
    // create comment and save it
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required',
            'author_name' => 'required',
            'author_email' => 'required|email',
            'article_id' => 'required',
        ]);

        $comment = Comment::create([
          'content' => $validatedData['content'],
          'author_name' => $validatedData['author_name'],
          'author_email' => $validatedData['author_email'],
          'article_id' => $validatedData['article_id'],
          'user_id' => auth()->id(),
        ]);

        // Find the email verification record for the comment, if it exists
        $emailVerification = $comment->emailVerification();

        // Generate a unique token for email verification
        $token = bin2hex(random_bytes(16));

          if ($emailVerification) {
            // Update the existing email verification record with the new token
            $emailVerification->token = $token;
            $emailVerification->save();
        } else {
            // Create a new email verification record
            $verification = EmailVerification::create([
                'email' => $validatedData['author_email'],
                'token' => $token,
                'comment_id' => $comment->id,
            ]);
        }

        // Send an email to the comment author with the verification link
        $verificationLink = route('comments_verify', $verification->token);
        $authorName = $validatedData['author_name'] ?? '';
        $authorEmail = $validatedData['author_email'];
        Mail::to($authorEmail)->send(new CommentVerificationMail($verificationLink, $authorName));

        return redirect()->back()->with('success', 'A verification email has been sent to your email address. Please click the verification link to post your comment.');
    }

    // verify comment and update it
    public function verify($token)
    {
        // Find the email verification record for the given token
        $verification = EmailVerification::where('token', $token)->firstOrFail();

        // Find the comment for the email verification record
        $comment = $verification->comment;

        // Mark the comment as verified
        $comment->is_verified = true;
        $comment->save();

        return redirect()->back()->with('success', 'Your comment has been verified and posted successfully!');
    }

    // delete comment
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }
}
