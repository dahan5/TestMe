<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Traits\UuidTrait;

class AdminSubject extends Model
{
    //
    protected $table = 'admin_subject';
    protected $fillable = ['admin_id','subject_id'];
    protected $appends = ['subject_name','alias'];
    public $timestamps = false;

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function classes() {
        return $this->belongsToMany(Classes::class, 'adminsubject_class', 'adminsubject_id', 'class_id')
        ->using(new class extends Pivot {
            use UuidTrait;
        });
    }

    public function getSubjectNameAttribute() {
        return $this->subject->subject_name;
    }

    public function getAliasAttribute() {
        return $this->subject->alias;
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
