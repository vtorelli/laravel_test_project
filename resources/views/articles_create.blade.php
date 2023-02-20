@extends('layout')

@section('content')

  <h1>Create New Article</h1>

  <form method="POST" action="{{ route('articles_store') }}" enctype="multipart/form-data">
    @csrf
    <div>
      <label for="title">Title</label>
      <input type="text" name="title" value="{{ old('title') }}" required>
      @error('title')
        <div>{{ $message }}</div>
      @enderror
    </div>
    <div>
      <label for="content">Content</label>
      <textarea name="content" required>{{ old('content') }}</textarea>
      @error('content')
        <div>{{ $message }}</div>
      @enderror
    </div>
    <div>
      <label for="author">Author</label>
      <input type="text" name="author" value="{{ old('author') }}" required>
      @error('author')
        <div>{{ $message }}</div>
      @enderror
    </div>
    <div>
      <label for="image">Image</label>
      <input type="file" name="image" accept="image/*">
      @error('image')
        <div>{{ $message }}</div>
      @enderror
    </div>
    <div>
      <button type="submit">Create Article</button>
    </div>
  </form>

@endsection
