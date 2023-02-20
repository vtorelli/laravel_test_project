@extends('layout')

@section('title')
  {{ $article->title }}
@endsection

@section('content')

<div class="main-container article-container">

  <h1>{{ $article->title }}</h1>
  <p>written by <a href="{{ '/users/' . $article->author->id }}">{{ $article->author->name }}</a></p>

  @foreach(explode("\n", $article->content) as $paragraph)
    <p class="article-content-paragraph">{{ $paragraph }}</p>
  @endforeach

  <hr>
  <h2>Comments</h2>

  <h2>Leave a Comment</h2>

  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form method="POST" action="{{ route('comments_store') }}">
      @csrf
      <input type="hidden" name="article_id" value="{{ $article->id }}">
      <div class="form-group">
          <label for="author_name">Name</label>
          <input type="text" class="form-control" id="author_name" name="author_name" placeholder="Enter your name">
      </div>
      <div class="form-group">
          <label for="author_email">Email</label>
          <input type="email" class="form-control" id="author_email" name="author_email" placeholder="Enter your email">
      </div>
      <div class="form-group">
          <label for="content">Comment</label>
          <textarea class="form-control" id="content" name="content" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  @foreach($comments as $comment)
    <div class="comment">
      <h4><strong><a href="mailto:{{ $comment->author_email }}">{{ $comment->author_name }}</a></strong></h4>
      <p>{{ $comment->content }}</p>
      <p><strong>{{ date('d/m/Y @ H:i', strtotime($comment->created_at)) }}</strong></p>
    </div>
    <hr style="color: gray;">
  @endforeach

</div>

@endsection
