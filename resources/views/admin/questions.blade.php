@extends('layouts.main')
@section('title') {{$current_class->class}} {{ucfirst($subject->subject_name)}} Questions @endsection
@section('content')

    <div id="app">
        <v-app>
            <add-question :subject="'{{$subject->id}}'" :class-id="'{{$class_id}}'" :exams="{{$exams}}"></add-question>
        </v-app>
    </div>

    <script src="{{asset('/js/app.js')}}"></script>
@endsection



