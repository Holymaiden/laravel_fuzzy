<?php

namespace App\Repositories;

use App\Models\Classes;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ClassesContract;


class ClassesRepository extends BaseRepository implements ClassesContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Classes $classes)
    {
        $this->model = $classes->whereNotNull('id');
    }
}
