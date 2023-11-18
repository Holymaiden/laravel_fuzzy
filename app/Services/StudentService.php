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

        $year = SchoolYear::firstOrCreate(['name' => $input['school_year_id']], ['semester' => $input['semester']]);

        $student = Student::create([
            'name' => $input['name'],
            'jkl' => $input['jkl'],
            'nisn' => $input['nisn'],
            'nis' => $input['nis'],
        ]);

        Value::create([
            'student_id' => $student->id,
            'school_year_id' => $year->id,
            'class_id' => $input['class_id'],
        ]);

        return true;
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

        $year = SchoolYear::where('name', $input['school_year_id'])->where('semester', $input['semester'])->first();
        if (!$year) {
            $year = SchoolYear::create(['name' => $input['school_year_id'], 'semester' => $input['semester']]);
        }

        $value = Value::where('id', $input['idValue'])->first();
        $value->school_year_id = $year['id'];
        $value->class_id = $input['class_id'];
        $value->save();

        return $this->contractRepo->update($input, $id);
    }

    /**
     * Delete Data By ID
     */
    public function delete($id)
    {
        Value::where('student_id', $id)->delete();
        return $this->contractRepo->delete($id);
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

    public function student_evaluation_show($id)
    {
        return Student::find($id)->value->evaluation;
    }

    public function student_evaluation_update($request, $id)
    {
        $input = $request->all();

        $eval = [$input['spiritual'], $input['sosial'], $input['akademik'], $input['ekstrakulikuler']];
        $data = [];
        for ($i = 0; $i < 4; $i++) {
            $data['value_id'] = $input['value_id'];
            $data['evaluation_id'] = $i + 1;
            $data['value'] = $eval[$i];

            StudentEvaluation::where('value_id', $input['value_id'])->where('evaluation_id', $i + 1)->update($data);
        }

        return true;
    }
}
