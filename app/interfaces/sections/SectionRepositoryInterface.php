<?php
namespace App\interfaces\sections;

interface SectionRepositoryInterface
{
    // iview
public function index();

//add
public function store($request);

//edit
public function update($request);

//delete
public function destroy($request);

//
//edit
public function show($id);

}