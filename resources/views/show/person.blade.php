@extends('layouts.main')
@section('title', $person->screen_name)
@section('content')
@include('show.person_info')
@endsection