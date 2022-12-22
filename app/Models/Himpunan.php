<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Himpunan extends Model
{
    use HasFactory;
    protected $fillable = [
        'evaluation_id',
        'name',
        'min',
        'max',
    ];

    public function evaluation()
    {
        return $this->hasOne('App\Models\Evaluation', 'id', 'evaluation_id');
    }
}
