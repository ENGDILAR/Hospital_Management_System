<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\interfaces\LabEmployee\LabEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class LaboratorieEmployeeController extends Controller
{
 private $LabEmployee;
     public function __construct(LabEmployeeRepositoryInterface $LabEmployee)
     {
        $this->LabEmployee = $LabEmployee;
     }
    public function index( )
    {
       return $this->LabEmployee->index();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->LabEmployee->store($request);
    }

  
    public function update(Request $request, string $id)
    {
      return $this->LabEmployee->update($request,$id);
    }

    public function destroy(string $id)
    {
      return $this->LabEmployee->destroy($id);
    }
}
