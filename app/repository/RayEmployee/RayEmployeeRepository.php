<?php

namespace App\repository\RayEmployee;

use App\interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Models\RayEmployee;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface
{
    

    public function index()
    {
   
        $ray_employees = RayEmployee::all();
        return view('Dashboard.ray_employee.index',compact('ray_employees'));
    }

    public function store($request)
    {
        try {

            $ray_User = new User();
            $ray_User->email = $request->email;
            $ray_User->password = Hash::make($request->password);
            $ray_User->name = $request->name;
            $ray_User->role = "ray";
            $ray_User->save();


            $ray_employee = new RayEmployee();
            $ray_employee->user_id = $ray_User->id;
            $ray_employee->name = $request->name;
            $ray_employee->email = $request->email;
            $ray_employee->password = Hash::make($request->password);
            $ray_employee->save();
            session()->flash('add');
            return back();

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        $input = $request->all();
       // if Paswword Passed Edt It
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else{
              // if the Pasword Didnot Sended Let it Like The Old PassWord
              // Laravel Helper
            $input = Arr::except($input, ['password']);
        }

        $ray_employee = RayEmployee::find($id);
        $ray_employee->update($input);
        

        $Ray_User = User::findorfail($ray_employee->user_id);
        $Ray_User->email = $request->email;
        $Ray_User->password = Hash::make($request->password);
        $Ray_User->name = $request->name;
        $Ray_User->role = "ray";
        $Ray_User->save();


        session()->flash('edit');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            $ray_employee = RayEmployee::find($id);
            RayEmployee::destroy($id);
            User::destroy($ray_employee->user_id);
            session()->flash('delete');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
