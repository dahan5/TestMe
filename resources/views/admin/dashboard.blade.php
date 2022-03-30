@extends('layouts.main')
@section('title', 'Dashboard')
@section('pageHeader', 'Dashboard')
@section('content')
@can('superAdminGate')
    <div class="container" id="app" data-app="true">
        <class-classes :allclasses="{{$classes}}" :isadmin="{{json_encode(auth()->user()->can('superAdminGate'))}}"></class-classes>
    </div>
    <main role="main">
        <h4>Candidates</h4>
        <hr>
        <div class="card-deck">

            @foreach ($classes as $class)
                <div class="card">
                    <div class="card-body">
                    <a href="/admin/students#{{strtolower($class->class)}}" class="text-dark">
                            <h5 class="card-title">{{strtoupper($class->class)}}</h5>
                            <p class="card-text">{{$class->students()->withTrashed()->count()}} Candidates</p>
                        </a>
                    </div>

                </div>
            @endforeach

            <class-students :allclasses="{{$classes}}" :isadmin="{{json_encode(auth()->user()->can('superAdminGate'))}}"></class-students>
        </div>
    </main>
    <hr>
@endcan
    <div id="app" data-app="true">
        <subjects :subjects="{{$subjects}}" :exams="{{$exams}}" :classes="{{$classes}}"></subjects>
    </div>


    <script src="{{asset('/js/app.js')}}"></script>
@endsection
