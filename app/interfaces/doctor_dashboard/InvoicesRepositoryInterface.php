<?php

namespace App\interfaces\doctor_dashboard;

interface InvoicesRepositoryInterface
{


    public function index();
    
    public function reviewInvoices();
    
    public function completedInvoices();

         public function show($id);
}



?>