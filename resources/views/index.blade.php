@extends('layout')

@section('content')

<div class="main-header">
  <h1>MY FIRST LARAVEL BLOG</h1>
</div>

<div class="main-container">
  <div class="article-cards">
    @if (!empty($articles))
      @foreach ($articles as $article)

      <a href="{{ route('article_show', ['id' => $article->id]) }}">
        <div class="card">
          <h2>{{ $article->title }}</h2>
          <p>{{ Str::limit($article->content, 200) }}</p>
        </div>
      </a>

      @endforeach
    @else
      <p>No articles found.</p>
    @endif

    <a href="{{ route('articles_create') }}" class="btn btn-primary">Create New Article</a>
  </div>
</div>

@endsection
