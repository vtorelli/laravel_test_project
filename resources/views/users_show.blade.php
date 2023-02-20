@extends('layout')

@section('content')

  <h1>{{ $user->name }}</h1>
  <p>{{ $user->email }}</p>
  <img src="{{ asset($user->avatar) }}" alt="User Avatar">

@endsection
