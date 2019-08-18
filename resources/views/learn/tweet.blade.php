@extends('layouts.main')
@section('title', 'learning')
@section('content')
  <div class="row list-row" style="margin-bottom: 25px; margin-top: 25px;">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              @if($tweet->lang == 'fa')
                <p style="direction: rtl; text-align: right;">{{$tweet->full_text}}</p>
              @else
                <p>{{$tweet->full_text}}</p>
              @endif
            </div>
            <div class="col-md-4">
              <i class="fa fa-heart" aria-hidden="true"></i> {{$tweet->favorite_count}}
            </div>
            <div class="col-md-4">
              <i class="fa fa-retweet" aria-hidden="true"></i> {{$tweet->retweet_count}}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <p>After reading the tweet you can tell what the tweets are about and what they mean or what they mean. Tell Tina about her words by checking them out.</p>
            </div>
            @foreach(\App\Models\Subject::all() as $subject)
              <div class="col-md-2 col-sm-3">
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" name="subject_{{$subject->id}}" id="subject-{{$subject->id}}">
                  <label class="form-check-label" for="subject-{{$subject->id}}">{{$subject->title}}</label>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection