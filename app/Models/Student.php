<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    // protected $table = 'role';
    protected $fillable = [
        "name",
        "jkl",
        "nisn",
        "nis",
    ];

    public function value()
    {
        return $this->hasOne('App\Models\Value', 'student_id', 'id')->orderBy('id', 'desc');
    }
}
