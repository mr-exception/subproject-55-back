@extends('layouts.main')
@section('title', $screen_name)
@section('content')
  <style>
    .list-row > .col-md-12 {
      margin-top: 15px;
    }
  </style>
  <div class="row list-row">
    @include('components.search')
    @include('components.person_info')
    @include('components.charts.TRL')
    @include('components.charts.MRU')
  </div>
@endsection