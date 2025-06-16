<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\interfaces\doctor_dashboard\RaysRepositoryInterface;
use Illuminate\Http\Request;

class RayController extends Controller
{
    private $ray;

    public function __construct(RaysRepositoryInterface $ray)
    {
        $this->ray = $ray;
    }


    public function store(Request $request)
    {
        return $this->ray->store($request);
    }


    public function update(Request $request, $id)
    {
        return $this->ray->update($request,$id);
    }


    public function destroy($id)
    {
        return $this->ray->destroy($id);
    }
}
