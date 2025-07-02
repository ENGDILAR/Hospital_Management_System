<?php

namespace App\interfaces\LabEmployee_Dashboard;

interface InvoicesRepositoryInterface
{
    public function index();
    public function completed_invoices();
    public function edit($id);
    public function update($request,$id);
    public function view_laboratories($id);
      public function destroy($id);
}
