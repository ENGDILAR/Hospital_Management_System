<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Doctor;
use Illuminate\Http\Request;

class doctorcontroller extends Controller
{

    //** now we have to implment the repository to use  the method that we make it by pattern desigen that we have made  */
    private $Doctors;

    public function __construct(DoctorRepositoryInterface $Doctors)
    {
        $this->Doctors = $Doctors;
    }
    public function index()
    {
    return $this->Doctors->index();
    }

    public function create()
    {
        return $this->Doctors->create();
    }


    public function store(Request $request)
    {
      return $this->Doctors->store($request);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Doctors->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
     
        return $this->Doctors->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Doctors->destroy($request);
    }

    public function update_password(Request $request)
    {
  $request->validate([
      'password'=>'required|min:6|confirmed',
  'password_confirmation'=>'required|min:6'
  ]);
  
  return $this ->Doctors->update_password($request);

    }


    public function update_status(Request $request)
    {
     
        $request->validate([
            'status'=>'required|in:0,1',
        ]);
        return $this->Doctors->update_status($request);

    }

}
