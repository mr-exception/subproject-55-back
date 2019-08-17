@extends('layouts.main')
@section('title', $screen_name)
@section('content')
  @include('components.search')
  @include('components.person_info')
  @include('components.charts.TRL')
@endsection