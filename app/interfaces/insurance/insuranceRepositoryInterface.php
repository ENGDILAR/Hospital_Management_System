<?php

namespace App\interfaces\insurance;

interface insuranceRepositoryInterface
{
     //get all insurance
    public function index();

    //create new 
    public function create();

    //store new 
    public function store($request);

    //edit insurance 
    public function edit($id);

    //update insurance
    public function update($request);

    //delete insurance 
    public function destroy($request);


}
