<?php

namespace App\Http\Controllers\LabEmployee_Dashboard;

use App\Http\Controllers\Controller;
use App\interfaces\LabEmployee_Dashboard\InvoicesRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

   private $Lab_Employee;

    public function __construct(InvoicesRepositoryInterface $Lab_Employee)
    {
        $this->Lab_Employee = $Lab_Employee;
    }

    public function index()
    {
       return $this->Lab_Employee->index();
    }

    public function completed_invoices()
    {
        return $this->Lab_Employee->completed_invoices();
    }


    public function edit($id)
    {
        return $this->Lab_Employee->edit($id);
    }

    public function view_laboratories($id)
    {
        return $this->Lab_Employee->view_laboratories($id);
    }


    public function update(Request $request, $id)
    {
        return $this->Lab_Employee->update($request,$id);
    }


    public function destroy($id)
    {
       
    }
}
