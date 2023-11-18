<?php

namespace App\Services\Contracts;

interface StudentContract
{
    public function getAll();

    public function store($request);

    public function update($update, $id);

    public function show($id);

    public function delete($id);

    public function paginate();

    public function evaluation($request);

    public function student_evaluation_show($id);

    public function student_evaluation_update($request, $id);
}
