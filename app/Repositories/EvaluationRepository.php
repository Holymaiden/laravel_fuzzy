<?php

namespace App\Repositories;

use App\Models\Evaluation;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\EvaluationContract;


class EvaluationRepository extends BaseRepository implements EvaluationContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Evaluation $evaluation)
    {
        $this->model = $evaluation->whereNotNull('id');
    }
}
