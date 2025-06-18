<?php

namespace App\repository\LaboratorieEmployee;
use App\interfaces\LabEmployee\LabEmployeeRepositoryInterface;

use App\Models\LaboratorieEmployee;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class LaboratorieEmployeeRepository implements LabEmployeeRepositoryInterface
{

    public function index()
    {
        $laboratorie_employees = LaboratorieEmployee::all();
        return view('Dashboard.laboratorie_employee.index',compact('laboratorie_employees'));
    }

    public function store($request)
    {
        try {
            $lab_User = new User();
            $lab_User->email = $request->email;
            $lab_User->password = Hash::make($request->password);
            $lab_User->name = $request->name;
            $lab_User->role = "lab";
            $lab_User->save();


            $laboratorie_employee = new LaboratorieEmployee();
            $laboratorie_employee->user_id =$lab_User->id; 
            $laboratorie_employee->name = $request->name;
            $laboratorie_employee->email = $request->email;
            $laboratorie_employee->password = Hash::make($request->password);
            $laboratorie_employee->save();
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

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else{
            $input = Arr::except($input, ['password']);
        }

        $lab_employee = LaboratorieEmployee::find($id);
        $lab_employee->update($input);

        $Lab_User = User::findorfail($lab_employee->user_id);
        $Lab_User->email = $request->email;
        $Lab_User->password = Hash::make($request->password);
        $Lab_User->name = $request->name;
        $Lab_User->role = "ray";
        $Lab_User->save();

        session()->flash('edit');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            $lab_employee = LaboratorieEmployee::find($id);
            LaboratorieEmployee::destroy($id);
             User::destroy($lab_employee->user_id);
            session()->flash('delete');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
