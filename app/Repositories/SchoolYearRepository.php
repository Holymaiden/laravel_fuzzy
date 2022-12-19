<?php

namespace App\Repositories;

use App\Models\SchoolYear;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\SchoolYearContract;


class SchoolYearRepository extends BaseRepository implements SchoolYearContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(SchoolYear $schoolYear)
    {
        $this->model = $schoolYear->whereNotNull('id');
    }
}
