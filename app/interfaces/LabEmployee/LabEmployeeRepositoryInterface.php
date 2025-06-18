<?php

namespace App\interfaces\LabEmployee;

interface LabEmployeeRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

}
