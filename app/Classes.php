<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Mark;

class Classes extends Model
{
    protected $table = 'classes';

    public function students() {
        return $this->hasMany(User::class, 'class_id');
    }

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'class_subject','class_id');
    }

    public function admins() {
        return $this->belongsToMany(Admin::class);
    }

    public function hasStarted($subject_id) {
        //check if a specific class has started exams for a specific subject
        $mark = Mark::where('subject_id',$subject_id)->where('class_id', $this->id)->first();
        return  $mark ? $mark->hasStarted : 0;
    }

    public function hasPendingExamToday($subject_id) {
        //check if a specific class has started exams for a specific subject
        $exam = Exam::where('subject_id',$subject_id)->where('class_id',$this->id)->orderBy('date','desc')->orderBy('updated_at','desc')->first();

        if (!$exam) {
            return false;
        }
        else {
            //only return true for subjects that have questions
            return $exam->date == date('Y-m-d') && count($exam->questions) > 0;
        }
    }

    public function getAllExams($subject_id) {
        $exams = Exam::where('subject_id',$subject_id)->where('class_id',$this->id)->orderBy('date','desc')->orderBy('updated_at','desc')->get();

        return $exams;
    }

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    public $keyType = 'string';

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->id = Str::uuid()->toString();
            }
        });
    }
}

