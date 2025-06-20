<?php
namespace App\repository\Doctors;
use App\Trait\UploadTrait;
use App\interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\appointment;
use App\Models\Doctor;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Comment\Doc;

class DoctorRepository implements DoctorRepositoryInterface
{
  
    use UploadTrait;
// if we using desigen pattern that mean our request not going directly to the controller 
//but from route-> repository(your methodes comes from the interface ) -> controller 
public function index()
{
    // $doctors = Doctor::all();
    $doctors=Doctor::with('doctorappointments')->get();
   return view('Dashboard/Doctors.index',compact('doctors'));
}



public function create()
{
    // get all of the section because wehn we add a doctor we should add his section 
    $sections = Section::all();
    // get all of the appointments because wehn we add a doctor we should add his apppointments 
    $appointments = appointment::all();
   return view('Dashboard/Doctors.add',compact(['sections','appointments']));
}

public function store($request)
{
    
    // insert in doctor table and in same time insert in image table

DB::beginTransaction();// all of the steps will excute together or not 
//wich mean if first transaction excuted succefully and the secounnd failed then the first tr will be deleted from db also
try {


    $doctor_User = new User();
    $doctor_User->email = $request->email;
    $doctor_User->password = Hash::make($request->password);
    $doctor_User->name = $request->name;
    $doctor_User->role = "doctor";
    $doctor_User->save();

    $doctors = new Doctor();
    $doctors->email = $request->email;
    $doctors->user_id = $doctor_User->id;
    $doctors->password = Hash::make($request->password);
    $doctors->section_id = $request->section_id;
    $doctors->phone = $request->phone;
    $doctors->status = 1;
    $doctors->save();

    // store trans
    $doctors->name = $request->name;
    $doctors->save();
    $doctors->doctorappointments()->attach($request->appointments);
    //Upload img
    $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctors->id,'App\Models\Doctor');

    DB::commit();
    session()->flash('add');
    return redirect()->route('Doctors.create');

}
catch (\Exception $e) {
    DB::rollback();// delete the excuted transaction 
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}


}

public function update($request)
{
    DB::beginTransaction();

    try {

     

        $doctor = Doctor::findorfail($request->id);
        $doctor->email = $request->email;
        $doctor->section_id = $request->section_id;
        $doctor->phone = $request->phone;
        $doctor->save();


        $doctor_User = User::findorfail($doctor->user_id);
        $doctor_User->email = $request->email;
        $doctor_User->password = Hash::make($request->password);
        $doctor_User->name = $request->name;
        $doctor_User->role = "doctor";
        $doctor_User->save();


        // store trans
        $doctor->name = $request->name;
        $doctor->save();

        // update pivot tABLE
        $doctor->doctorappointments()->sync($request->appointments);

        // update photo
        if ($request->has('photo')){
            // Delete old photo
            if ($doctor->image){
                $old_img = $doctor->image->filename;
                $this->Delete_attachment('upload_image','doctors/'.$old_img,$request->id);
            }
            //Upload img
            $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$request->id,'App\Models\Doctor');
        }

        DB::commit();
        session()->flash('edit');
        return redirect()->back();

    }
    catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}



public function destroy($request)
{
          $doctor = Doctor::findorfail($request->id);
    
         if($request->page_id == 1)
         {
            // if we select a single doctor to delete 
            // first ask if he have an image
            if($request->filename)
            {
                //delet it from the disk and the db
                //filename is the name of a colum in image table
                $this->Delete_attachment('upload_image','doctors'.$request->filename,$request->id,$request->filename);
            }
            // after deleting the photo delete the doctor 
            Doctor::destroy($request->id);
            if($doctor->user_id != null)
            {
    User::destroy($doctor->user_id);
            }
        
            session()->flash('delete');
            return redirect()->route('Doctors.index');

         }
         else
         {
            // came from delete selected id=delete_select_id  and store them in array{"1","2","3"}
            // expload to put a , between each id 
            $delete_select_id =explode(",",$request->delete_select_id);
            //for each selected ips
            foreach ($delete_select_id as $ids_doctors ) {
            //get the doctor that have that id and 
                $doctor=Doctor::findorfail($ids_doctors);
                //cheak if the doctor have an image 
                if($doctor->image)
                {
                    //delete that image 
                    $this->Delete_attachment('upload_image','doctors'.$request->filename,$ids_doctors,$doctor->image->filename);
                }
            }

                   Doctor::destroy($delete_select_id);
                   session()->flash('delete');
                   return redirect()->route('Doctors.index');
         }
}

public function edit ($id)
{
 $sections = Section::all();
 $appointments = appointment::all();
 $doctor=Doctor::findorfail($id);
 return view('Dashboard.Doctors.edit',compact(['sections','appointments','doctor']));
}
   
public function update_password($request)
{
    try {
        $doctor = Doctor::findorfail($request->id);

        $user = User::findorfail($doctor->user_id);
        $doctor->update([
       'password'=>Hash::make($request->password)
        ]);

        $user->update([
            'password'=>Hash::make($request->password)
        ]);

        
        session()->flash('edit');
        return redirect()->back();

    } 
    catch (\Exception $e) {
        //throw $th;
        return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
    }
    
}

public function update_status($request)
{
    try {
        $doctor = Doctor::findorfail($request->id);
        $doctor->update([
       'status'=>$request->status
        ]);

        session()->flash('edit');
        return redirect()->back();

    } 
    catch (\Exception $e) {
        //throw $th;
        return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
    }
    
}

}
// we will make a new provider by name repositoryServiceProvider 