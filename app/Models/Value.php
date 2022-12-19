<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'class_id',
        'school_year_id',
    ];

    public function student()
    {
        return $this->hasOne('App\Models\Student', 'id', 'student_id');
    }

    public function classes()
    {
        return $this->hasOne('App\Models\Classes', 'id', 'class_id');
    }

    public function schoolYear()
    {
        return $this->hasOne('App\Models\SchoolYear', 'id', 'school_year_id');
    }

    public function evaluation()
    {
        return $this->hasMany('App\Models\StudentEvaluation', 'id', 'evaluation_id');
    }
}
