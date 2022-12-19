<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\StudentContract;


class StudentRepository extends BaseRepository implements StudentContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Student $student)
    {
        $this->model = $student->whereNotNull('id');
    }

    public function show($id)
    {
        return $this->model->with('value')->first();
    }
}
