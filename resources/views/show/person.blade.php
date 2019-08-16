@extends('layouts.main')
@section('title', $person->screen_name)
@section('content')
@include('components.search', ['person' => $person])
@include('components.person_info')
@endsection