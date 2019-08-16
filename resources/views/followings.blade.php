@extends('layouts.main')
@section('title', 'followings of ' . $source->screen_name)
@section('content')
  @include('components.search', ['person' => $source])
  @if(sizeof($persons) > 0)
    @foreach($persons as $person)
      @include('components.person_info')
    @endforeach
    <div class="row justify-content-center" style="margin-top: 25px;">
      {{$persons->links()}}
    </div>
  @else
    <div class="row justify-content-center" style="margin-top: 25px;">
      no followings found.
    </div>
  @endif
@endsection