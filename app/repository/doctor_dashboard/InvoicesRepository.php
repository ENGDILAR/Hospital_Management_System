<?php

namespace App\repository\doctor_dashboard;

use App\interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Ray;
use Illuminate\Support\Facades\Auth;

class InvoicesRepository implements InvoicesRepositoryInterface
{

    public function index()
    {
         $id=Auth::user()->id;
         
          $doctor = Doctor::where('user_id',$id)->firstOrfail();
      
      
         $invoices = Invoice::where('doctor_id',$doctor->id)->where('invoice_status',1)->get();
         return view('Dashboard.Doctor.invoices.index',compact('invoices'));
    }

     // قائمة المراجعات
     public function reviewInvoices()
     {
         $id=Auth::user()->id;
          $doctor = Doctor::where('user_id',$id)->firstOrfail();
      
         $invoices = Invoice::where('doctor_id',$doctor->id)->where('invoice_status', 2)->get();
         return view('Dashboard.Doctor.invoices.review_invoices', compact('invoices'));
     }
 
     // قائمة الفواتير المكتملة
     public function completedInvoices()
     {
         $id=Auth::user()->id;
          $doctor = Doctor::where('user_id',$id)->firstOrfail();
      
         $invoices = Invoice::where('doctor_id', $doctor->id)->where('invoice_status', 3)->get();
         return view('Dashboard.Doctor.invoices.completed_invoices', compact('invoices'));
     }
 // View Ray Photo
     public function show($id)
     {
           
            $User=Auth::user()->id;
          $doctor = Doctor::where('user_id',$User)->firstOrfail();

         $rays = Ray::findorFail($id);
        if($rays->doctor_id !=$doctor->id){
            abort(404);
        }

    
        return view('Dashboard.Doctor.invoices.view_rays', compact('rays'));
     }

    
}



?>