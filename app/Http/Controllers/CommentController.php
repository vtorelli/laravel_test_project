<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    // create comment and save it
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'required',
            'article_id' => 'required',
        ]);

        $comment = Comment::create([
            'body' => $validatedData['body'],
            'article_id' => $validatedData['article_id'],
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    // delete comment
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }
}
