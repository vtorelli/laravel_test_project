@extends('layout')

@section('title')
  {{ $article->title }}
@endsection

@section('content')

  @method('PUT')
    @csrf
    <form method="POST" action="{{ route('articles.update', $article->id) }}">
      <input type="text" name="title" value="{{ $article->title }}" required>
      <textarea name="content" required>{{ $article->content }}</textarea>
      <input type="text" name="author" value="{{ $article->author }}" required>
    </form>

@endsection
