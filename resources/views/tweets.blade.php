@extends('layouts.main')
@section('title', 'tweets of ' . $source->screen_name)
@section('content')
  @include('components.search', ['person' => $source])
  @foreach($tweets as $tweet)
    @include('components.tweet_info')
  @endforeach
  <div class="row justify-content-center" style="margin-top: 25px;">
    {{$tweets->links()}}
  </div>
@endsection