<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Models\Doctor;
use App\Models\Laboratorie;
use App\Models\Ray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientDetailesController extends Controller
{
    public function index($id){
        
        $user_id=Auth::user()->id;
        $SignedDoctorID = Doctor::where('user_id',$user_id)->firstOrfail();


        $patient_records = Diagnostic::where('patient_id',$id)->get();
        $patient_rays = Ray::where('patient_id',$id)->get();
        $patient_Laboratories  = Laboratorie::where('patient_id',$id)->get();
        return view('Dashboard.doctor.invoices.patient_details',compact('patient_records','patient_rays','SignedDoctorID','patient_Laboratories'));
    }
}
