<?php

namespace App\Repositories;

use App\Models\Himpunan;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\HimpunanContract;


class HimpunanRepository extends BaseRepository implements HimpunanContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Himpunan $himpunan)
    {
        $this->model = $himpunan->whereNotNull('id');
    }
}
