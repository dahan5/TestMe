@extends('layouts.main')
@section('title') {{$current_class->class}} Exam Results @endsection
@section('content')

    <div class="container" id="app" data-app="true">
        <h3 class="text-center mt-5">
            {{$current_class->class}} Examination Results
        </h3>
        <hr>
        <table class="table table-sm mt-2 table-bordered text-center">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>NUMBER</th>
                    <th>NAME</th>
                    @foreach ($subjects as $key => $subject)
                    <th class="rotated-text">
                        <div><span>{{ $subject['subject_name'] }}</span></div>
                        <span style="color: red; font-weight: bolder">{{$subject['base_score']}}<span>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$student->code}}</td>
                    <td>{{$student->fullName}}</td>
                    @foreach ($subjects as $subject)
                    <td>{{ $student->subjects[$subject['alias']] ? $student->subjects[$subject['alias']]['actual_score'] : "-" }}</td>
                    @endforeach
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <script src="{{asset('/js/app.js')}}"></script>

@endsection

