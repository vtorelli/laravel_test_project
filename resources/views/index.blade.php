@extends('layout')

@section('content')

  <h1>My blog</h1>


    @if (!empty($articles))
      @foreach ($articles as $article)

      <h2>{{ $article->title }}</h2>
      <p>{{ $article->content }}</p>
      <p>Author: {{ $article->author }}</p>
      <!-- <a href="{{ route('articles_show', $article->id) }}">{{ $article->title }}</a> -->

      @endforeach
    @else
      <p>Wow, such empty.</p>
    @endif


@endsection
