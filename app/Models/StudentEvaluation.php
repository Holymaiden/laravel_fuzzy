<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEvaluation extends Model
{
        use HasFactory;
        protected $table = 'student_evaluation';
        protected $fillable = [
                'value_id',
                'evaluation_id',
                'value',
        ];

        public function value()
        {
                return $this->hasOne('App\Models\Value', 'id', 'value_id');
        }

        public function evaluation()
        {
                return $this->hasOne('App\Models\Evaluation', 'id', 'evaluation_id');
        }
}
