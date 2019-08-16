@extends('layouts.main')
@section('title', 'followers of ' . $source->screen_name)
@section('content')
  @include('components.search', ['person' => $source])
  @foreach($persons as $person)
    @include('components.person_info')
  @endforeach
  <div class="row justify-content-center" style="margin-top: 25px;">
    {{$persons->links()}}
  </div>
@endsection