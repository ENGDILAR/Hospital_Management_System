<?php

namespace App\repository\services;
use App\interfaces\services\singleservicerepositoryinterface;
use App\Models\service;

class singleservicerepository implements singleservicerepositoryinterface
{
  // dont fprget to check the declaration in App/providers/repositoryServiceProvider

    public function index()
    {
          $services = service::all();
          return view('Dashboard.Services.SingleService.index',compact('services'));
    }

public function store($request)
{

  try {
    // store service
    $singleservice = new Service();
    $singleservice->price=$request->price;
    $singleservice->description=$request->description;
    $singleservice->status=1;
    $singleservice->save();

    //store trans
    $singleservice->name=$request->name;
    $singleservice->save();

    session()->flash('add');
    return redirect()->route('services.index');

  } catch (\Exception $e) {
   return redirect()->back()->withErrors(['error'=>$e->getmessage()]);
  }
}

public function update($request)
{
  try {
    // store service
   $singleservice = Service::findorfail($request->id);
    $singleservice->price=$request->price;
    $singleservice->description=$request->description;
    $singleservice->status=$request->status;
    $singleservice->save();

    //store trans
    $singleservice->name=$request->name;
    $singleservice->save();

    session()->flash('edit');
    return redirect()->route('services.index');

  } catch (\Exception $e) {
   return redirect()->back()->withErrors(['error'=>$e->getmessage()]);
  }
}

public function destroy($request)
{
 service::destroy($request->id);
 session()->flash('delete');
 return redirect()->route('services.index');
}
}
