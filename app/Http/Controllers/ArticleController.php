<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
  public function index()
  {
      $articles = Article::all();
      // die(var_dump($articles));
      // \Log::debug(\DB::getQueryLog());
      return view('index', compact('articles'));
  }

  public function show($id)
  {
      $article = Article::findOrFail($id);
      $comments = $article->comments;
      return view('articles_show', compact('article', 'comments'));
  }

  public function create()
  {
      return view('articles_create');
  }

  public function store(Request $request)
  {
      $validatedData = $request->validate([
          'title' => 'required',
          'content' => 'required',
          'author' => 'required',
          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
      ]);

      $article = new Article;
      $article->title = $validatedData['title'];
      $article->content = $validatedData['content'];
      $article->author = $validatedData['author'];
      $article->image = $request->file('image')->store('public/images');

      $article->save();

      return redirect()->route('articles.show', $article->id);
  }

  public function edit($id)
  {
      $article = Article::findOrFail($id);
      return view('articles_edit', compact('article'));
  }

  public function update(Request $request, $id)
  {
      $validatedData = $request->validate([
          'title' => 'required',
          'content' => 'required',
          'author' => 'required',
      ]);

      $article = Article::findOrFail($id);
      $article->update($validatedData);

      return redirect('/articles/' . $article->id);
  }

  public function destroy($id)
  {
      $article = Article::findOrFail($id);
      $article->delete();

      return redirect('/articles');
  }

  public function upvote($id)
  {
      $article = Article::find($id);
      $article->increment('upvotes');
      $article->save();

      return redirect()->back();
  }
}
