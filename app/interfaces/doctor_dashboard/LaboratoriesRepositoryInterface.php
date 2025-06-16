<?php

namespace App\interfaces\doctor_dashboard;

interface LaboratoriesRepositoryInterface
{
    public function store($request);

    public function update($request,$id);

    public function destroy($id);
}
