<?php
namespace App\interfaces\Finance;

interface ReceiptRepositoryInterface
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


public function show($id);

}
//