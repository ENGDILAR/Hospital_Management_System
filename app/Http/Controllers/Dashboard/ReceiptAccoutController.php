<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\interfaces\Finance\ReceiptRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptAccoutController extends Controller
{
 
    private $Recipt;
    public function __construct(ReceiptRepositoryInterface $recipt)
    {
        return $this->Recipt=$recipt;
    }
    public function index()
    {
      return $this->Recipt->index();
    }

    public function create()
    {
      return $this->Recipt->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Recipt->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->Recipt->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Recipt->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Recipt->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Recipt->destroy($request);
    }
}
