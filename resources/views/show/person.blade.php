@extends('layouts.main')
@section('title', $screen_name)
@section('content')
  <style>
    .list-row > .col-md-12 {
      margin-top: 15px;
    }
  </style>
  <div class="row list-row" style="margin-bottom: 25px;">
    @include('components.search')
    @include('components.person_info')
    @include('components.charts.TRL')
    @include('components.charts.MRU')
    @include('components.charts.MFH')
    @include('components.charts.MMS')
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Learning
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <p>If you want to help with this project's data, Tina can better understand her Twitter accounts. You can make Tina's data stronger by clicking the bottom button and checking the tweets sent by this user. Thank you very much for your time.</p>
              <a href="{{route('web.learn', ['screen_name' => $screen_name, 'step' => 0])}}" class="btn btn-info">start learning</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection