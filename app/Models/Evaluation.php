<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    // protected $table = 'role';
    protected $fillable = [
        'value',
        'description',
    ];

    public function himpunan()
    {
        return $this->hasMany('App\Models\Himpunan', 'evaluation_id', 'id');
    }
}
