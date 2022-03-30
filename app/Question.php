<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    //Model to interact with the questions table
    protected $fillable = ['exam_id','question'];

    public function options() {
        return $this->hasMany(Option::class);
    }

    public function exam() {
        return $this->belongsTo(Exam::class);
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


