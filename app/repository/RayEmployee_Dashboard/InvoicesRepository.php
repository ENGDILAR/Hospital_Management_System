<?php

namespace App\repository\RayEmployee_Dashboard;

use App\interfaces\RayEmployee_Dashboard\InvoicesRepositoryInterface;
use App\Models\Ray;
use App\Models\RayEmployee;
use App\Trait\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicesRepository implements InvoicesRepositoryInterface
{
    use UploadTrait;

    
   public static function GetRayID()
   {
    $id=Auth::user()->id;
    $ray = RayEmployee::where('user_id',$id)->firstOrfail();
    return $ray->id;

   }

   public function index()
   {
       $invoices = Ray::where('case',0)->get();
       return view('Dashboard.dashboard_RayEmployee.invoices.index',compact('invoices'));
   }



   public function completed_invoices()
   {
    $id=$this->GetRayID();
 
       $invoices = Ray::where('case',1)->where('employee_id',$id)->get();
       return view('Dashboard.dashboard_RayEmployee.invoices.completed_invoices',compact('invoices'));
   }

    public function edit($id)
   {
       $invoice = Ray::findorFail($id);
       return view('Dashboard.dashboard_RayEmployee.invoices.add_diagnosis',compact('invoice'));
   }




   public function update($request, $id)
   {
       $invoice = Ray::findorFail($id);
       $Rid=$this->GetRayID();
       $invoice->update([
           'employee_id'=> $Rid,
           'description_employee'=> $request->description_employee,
           'case'=> 1,
       ]);


       if( $request->hasFile( 'photos' ) ) {

         foreach ($request->photos as $photo) {
             //Upload img
             $this->verifyAndStoreImageForeach($photo,'Rays','upload_image',$invoice->id,'App\Models\Ray');
         }

       }
       session()->flash('edit');
       return redirect()->route('invoices_ray_employee.index');

   }

   public function view_rays($id)
   {
    $Rid=$this->GetRayID();

       $rays = Ray::findorFail($id);
       if($rays->employee_id != $Rid){
           //abort(404);
           return redirect()->route('404');
       }
       return view('Dashboard.dashboard_RayEmployee.invoices.patient_details', compact('rays'));
   }

  public function destroy($id)
  {
    
  }
}
