<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Requests\StoreInsuranceRequest;
use App\interfaces\insurance\insuranceRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InsuranceController extends Controller
{
    private $insurances;
    public function __construct(insuranceRepositoryInterface $insurances)
    {
       $this->insurances=$insurances;
    }

    public function index()
    {
        return $this->insurances->index();

    }

    //create new 
    public function create()
    {
        return $this->insurances->create();
    }

    //store new 
    public function store(StoreInsuranceRequest $request)
    {
        return $this->insurances->store($request);

    }

    //edit insurance 
    public function edit($id)
    {
        return $this->insurances->edit($id);
    }

    //update insurance
    public function update(StoreInsuranceRequest $request)
    {
        return $this->insurances->update($request);
    }

    //delete insurance 
    public function destroy($id)
    {
        return $this->insurances->destroy($id);
    }

}
