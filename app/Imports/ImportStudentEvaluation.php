<?php

namespace App\Imports;

use App\Models\StudentEvaluation;
use Maatwebsite\Excel\Concerns\FromCollection;

class ImportStudentEvaluation implements FromCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection()
    {
        return StudentEvaluation::all();
    }
}
