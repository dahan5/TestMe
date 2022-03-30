@extends('layouts.main')
@section('title', 'All Exams')
@section('pageHeader', 'All Exams')
@section('content')

    <div class="container" id="app" data-app="true">
        <class-exams :exams="{{$exams}}" :classes="{{$classes}}"></class-exams>
    </div>

    <script src="{{asset('/js/app.js')}}"></script>
@endsection
