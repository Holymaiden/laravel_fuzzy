<?php

namespace App\Repositories;

use App\Models\Value;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ValueContract;


class ValueRepository extends BaseRepository implements ValueContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Value $value)
    {
        $this->model = $value->whereNotNull('id');
    }
}
