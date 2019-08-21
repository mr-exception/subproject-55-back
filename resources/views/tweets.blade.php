@extends('layouts.main')
@section('title', 'tweets of ' . $person->screen_name)
@section('content')
  <div class="row">
    <div class="col-md-12" style="margin-top: 50px; margin-bottom: 15px;">
      @foreach($tweets as $tweet)
        @include('components.tweet_info')
      @endforeach
    </div>
    <div class="col-md-12" style="margin-bottom: 20px; text-align: center">
      @if($page > 0)
        <a href="{{route('web.tweets',['screen_name' => $person->screen_name, 'page' => $page - 1])}}" class="btn btn-outline-primary"><<</a>
      @endif
      <a class="btn btn-primary text-white" disabled>{{$page+1}}</a>
      @if($page < $total-1)
        <a href="{{route('web.tweets',['screen_name' => $person->screen_name, 'page' => $page + 1])}}" class="btn btn-outline-primary">>></a>
      @endif
    </div>
  </div>
@endsection