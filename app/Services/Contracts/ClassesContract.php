<?php

namespace App\Services\Contracts;

interface ClassesContract
{
    public function getAll();

    public function store($request);

    public function update($update, $id);

    public function show($id);

    public function delete($id);

    public function paginate();
}
