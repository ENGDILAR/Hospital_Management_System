<?php

namespace App\Http\Controllers\Dashboard_Patient;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\Ray;
use App\Models\ReceiptAccount;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PatientDashboardController extends Controller
{
    public function GetPatientID()
    {
      $id=FacadesAuth::user()->id;
     $Patient = Patient::where('user_id',$id)->firstOrfail();
     return $Patient->id;
    }
    public function invoices(){
 
        $id = $this->GetPatientID();
        $invoices = Invoice::where('patient_id',$id)->get();
        return view('Dashboard.User.invoices',compact('invoices'));
    }

    public function laboratories(){
        $id = $this->GetPatientID();
        $laboratories = Laboratorie::where('patient_id',$id)->get();
        return view('Dashboard.User.laboratories',compact('laboratories'));
    }

    public function viewLaboratories($id){

        $PatientID = $this->GetPatientID();
        $laboratorie = Laboratorie::findorFail($id);
        if($laboratorie->patient_id != $PatientID){
            return redirect()->route('404');
        }
        return view('Dashboard.dashboard_LaboratorieEmployee.invoices.patient_details', compact('laboratorie'));
    }

    public function rays(){

           $PatientID = $this->GetPatientID();

        $rays = Ray::where('patient_id',$PatientID)->get();
        return view('Dashboard.User.rays',compact('rays'));
    }

    public function viewRays($id)
    {
        $PatientID = $this->GetPatientID();
        $rays = Ray::findorFail($id);
        if($rays->patient_id !=$PatientID){
            return redirect()->route('404');
        }
        return view('Dashboard.dashboard_RayEmployee.invoices.patient_details', compact('rays'));
    }

    public function payments(){
        $PatientID = $this->GetPatientID();
        $payments = ReceiptAccount::where('patient_id',$PatientID)->get();
        return view('Dashboard.User.payments',compact('payments'));
    }
}
