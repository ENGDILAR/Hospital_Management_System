<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\interfaces\doctor_dashboard\LaboratoriesRepositoryInterface;
use Illuminate\Http\Request;

class LaboratorieController extends Controller
{
    private $laboratorie;

    public function __construct(LaboratoriesRepositoryInterface $laboratorie)
    {
        $this->laboratorie = $laboratorie;
    }

    public function store(Request $request)
    {
        return $this->laboratorie->store($request);
    }


    public function update(Request $request, $id)
    {
        return $this->laboratorie->update($request,$id);
    }


    public function destroy($id)
    {
        return $this->laboratorie->destroy($id);
    }
}
