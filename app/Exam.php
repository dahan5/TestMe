<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Exam extends Model
{
    protected $fillable = ['class_id','subject_id','base_score','hours','minutes','date','hasStarted'];
    protected $appends = ['hasBeenWritten', 'questions'];

    //
    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function class() {
        return $this->belongsTo(Classes::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function scores() {
        return $this->hasMany(Score::class);
    }

    public function getHasBeenWrittenAttribute() {
        return count ($this->scores) > 0 ? true : false;
    }

    public function getQuestionsAttribute() {
        return $this->questions()->with('options')->get();
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
