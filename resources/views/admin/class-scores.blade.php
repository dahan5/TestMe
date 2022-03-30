@extends('layouts.main')
@section('title', 'All Candidates')
@section('pageHeader', 'All Candidates')
@section('content')

    <div class="container" id="app" data-app="true">
        <class-scores :allclasses="{{$classes}}" :isadmin="{{json_encode(auth()->user()->can('superAdminGate'))}}"></class-scores>
    </div>

    <script src="{{asset('/js/app.js')}}"></script>
@endsection
