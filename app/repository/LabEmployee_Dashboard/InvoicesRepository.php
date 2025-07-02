<?php

namespace App\repository\LabEmployee_Dashboard;

use App\interfaces\LabEmployee_Dashboard\InvoicesRepositoryInterface;
use App\Models\Laboratorie;
use App\Models\LaboratorieEmployee;
use App\Models\Ray;
use App\Models\RayEmployee;
use App\Trait\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicesRepository implements InvoicesRepositoryInterface
{
    use UploadTrait;

   public static function GetLabID()
   {
    $id=Auth::user()->id;
    $ray = LaboratorieEmployee::where('user_id',$id)->firstOrfail();
    return $ray->id;

   }

   public function index()
   {
       $invoices = Laboratorie::where('case',0)->get();
       return view('Dashboard.dashboard_LaboratorieEmployee.invoices.index',compact('invoices'));
   }




   public function completed_invoices()
   {
       $id=$this->GetLabID();
       $invoices = Laboratorie::where('case',1)->where('employee_id',$id)->get();
       return view('Dashboard.dashboard_LaboratorieEmployee.invoices.completed_invoices',compact('invoices'));
   }

    public function edit($id)
   {
       $invoice = Laboratorie::findorFail($id);
       return view('Dashboard.dashboard_LaboratorieEmployee.invoices.add_diagnosis',compact('invoice'));
   }




   public function update($request, $id)
   {
       $invoice = Laboratorie::findorFail($id);
       $Lid=$this->GetLabID();
       $invoice->update([
           'employee_id'=> $Lid,
           'description_employee'=> $request->description_employee,
           'case'=> 1,
       ]);



       if( $request->hasFile( 'photos' ) ) {

         foreach ($request->photos as $photo) {
             //Upload img
             $this->verifyAndStoreImageForeach($photo,'laboratories','upload_image',$invoice->id,'App\Models\Laboratorie');
         }

       }
       session()->flash('edit');
       return redirect()->route('invoices_laboratorie_employee.index');

   }

   public function view_laboratories($id)
   {
    $LID=$this->GetLabID();

       $laboratorie = Laboratorie::findorFail($id);
       if($laboratorie->employee_id != $LID){
     
           return redirect()->route('404');
       }
       return view('Dashboard.dashboard_LaboratorieEmployee.invoices.patient_details', compact('laboratorie'));
   }

  public function destroy($id)
  {
    
  }
}
