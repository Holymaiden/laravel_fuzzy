<?php

namespace App\Services;

use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\StudentEvaluation;
use App\Models\Value;
use App\Repositories\Contracts\StudentContract as StudentRepo;
use App\Services\Contracts\StudentContract;

class StudentService implements StudentContract
{
    protected $contractRepo;

    public function __construct(StudentRepo $contractRepo)
    {
        $this->contractRepo = $contractRepo;
    }

    /**
     * Get Data
     */
    public function getAll()
    {
        return $this->contractRepo->index();
    }

    /**
     * Store Data
     */
    public function store($request)
    {
        $input = $request->all();

        $year = SchoolYear::where('name', $input['school_year_id'])->where('semester', $input['semester'])->firstOrFail();

        Value::create([
            'student_id' => $input['id'],
            'school_year_id' => $year->id,
            'class_id' => $input['class_id'],
        ]);

        return $this->contractRepo->store($input);
    }

    /**
     * Get Data By ID
     */
    public function show($id)
    {
        return $this->contractRepo->show($id);
    }

    /**
     * Update Data By ID
     */
    public function update($request, $id)
    {
        $input = $request->all();

        $year = SchoolYear::where('name', $input['school_year_id'])->where('semester', $input['semester'])->firstOrFail();

        $value = Value::where('id', $input['idValue'])->first();
        $value->school_year_id = $year;
        $value->class_id = $input['class_id'];
        $value->save();

        return $this->contractRepo->update($input, $id);
    }

    /**
     * Delete Data By ID
     */
    public function delete($id)
    {
        return Value::where('id', $id)->delete();
    }

    /**
     * Get Data with Pagination
     */
    public function paginate($perPage = 0, $columns = array('*'))
    {
        $perPage = $perPage ?: config('constants.PAGINATION');

        return $this->contractRepo->paginate($perPage, $columns);
    }

    public function evaluation($request)
    {
        $input = $request->all();

        $eval = [$input['spiritual'], $input['sosial'], $input['akademik'], $input['ekstrakulikuler']];
        $data = [];
        for ($i = 0; $i < 4; $i++) {
            $data['value_id'] = $input['id'];
            $data['evaluation_id'] = $i + 1;
            $data['value'] = $eval[$i];

            StudentEvaluation::create($data);
        }

        return true;
    }
}
