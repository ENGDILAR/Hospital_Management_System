<?php

namespace App\interfaces\RayEmployee_Dashboard;

interface InvoicesRepositoryInterface
{
    public function index();
    public function completed_invoices();
    public function edit($id);
    public function update($request,$id);
    public function view_rays($id);
      public function destroy($id);
}
