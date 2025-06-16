<?php

namespace App\interfaces\doctor_dashboard;


use Illuminate\Http\Request;

interface DiagnosisRepositoryInterface
{
    public function index();

    public function store($request);
    
    public function show($id);
    public function addReview (Request $request);

    
}



?>