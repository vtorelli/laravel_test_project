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

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    // delete comment
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }
}
