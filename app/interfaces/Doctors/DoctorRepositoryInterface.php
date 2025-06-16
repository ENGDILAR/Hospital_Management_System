<?php
namespace App\interfaces\Doctors;

interface DoctorRepositoryInterface
{
    // iview
public function index();

//add
public function store($request);

//edit
public function update($request);

//delete
public function destroy($request);
// create
public function create();

// 
public function edit($id);
//update password
public function update_password( $request);

//update the status 
public function update_status( $request);



}