<?php

namespace App\Export;

use Maatwebsite\Excel\Concerns\FromArray;

class ExportPenilaian implements FromArray
{

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }
}
