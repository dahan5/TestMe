<?php

namespace App\Http\Controllers\Teacher;

use App\Classes;
use App\Exam;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = auth()->user()->subjects();
        $classes = Classes::get();
        $startedExams = Exam::started()->get();
        $pendingExamsForToday = Exam::canBeStarted()->get();

        if ($startedExams) {
            $startedExams = collect($startedExams)->map(function($exam) {
                return array(
                    'id' => $exam->id,
                    'subject' => $exam->subject,
                    'class' => $exam->class
                );
            });
        }

        return view('teacher.dashboard',compact('subjects','classes', 'startedExams','pendingExamsForToday'));
    }
}
