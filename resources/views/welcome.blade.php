
@extends('layouts.main')
@section('title', 'home')
@section('content')
  <div class="row" style="height: 150px;"></div>
  <div class="row justify-content-center">
    <div class="col-md-4 col-sm-8">
      <label style="width: 100%; text-align: center; font-size: 45px; font-weight: 600;">Tina</label>
      <label style="width: 100%; text-align: center; font-size: 12; font-weight: 100;">sub project 55</label>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8 col-sm-12" style="text-align: center; margin-top: 25px;">
      <form action="{{route('web.search')}}" method="GET">
        <div class="input-group">
          <input type="text" name="screen_name" class="form-control" placeholder="twitter username (eg: reza_binzar)">
          <div class="input-group-append">
            <button class="btn btn-outline-primary" type="submite">Search!</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection