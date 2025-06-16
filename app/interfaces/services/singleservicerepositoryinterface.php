<?php

namespace App\interfaces\services;

interface singleservicerepositoryinterface
{
// get single services
public function index();

public function store($request);

public function update($request);

public function destroy($request);


}
