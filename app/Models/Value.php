<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'class_id',
        'school_year_id',
        'evaluation_id',
        'value',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
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
        return $this->hasOne('App\Models\Evaluation', 'id', 'evaluation_id');
    }
}
