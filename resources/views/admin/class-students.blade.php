@extends('layouts.main')
@section('title', 'All Candidates')
@section('pageHeader', 'All Candidates')
@section('content')

    <div class="container" id="app" data-app="true">
        <class-students :allclasses="{{$classes}}" :isadmin="{{json_encode(auth()->user()->can('superAdminGate'))}}"></class-students>
    </div>

    <script src="{{asset('/js/app.js')}}"></script>
@endsection
