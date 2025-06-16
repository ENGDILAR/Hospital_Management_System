<?php
namespace App\repository\sections;

use App\interfaces\sections\SectionRepositoryInterface;
use App\Models\Doctor;
use App\Models\Section;

class SectionRepository implements SectionRepositoryInterface
{
// if we using desigen pattern that mean our request not going directly to the controller 
//but from route-> controller (take the request and send it with call methods from repository)->  repository(your methodes comes from the interface ) 
public function index()
{
 // we will make a variable to store the data from the model  and send it to the view  page that named Sections 

 //note we are getting the data from the sections but astratomic translation know wich table she have to select from it 
 // combact to return the data 
    $sections = Section::all();
   return view('Dashboard/Sections.index',compact('sections'));


}

public function store($request)
{

Section::create(
[  
    // the name that you gonna get it from create will be section name 
    'name'=> $request ->input('name'), 
   ]);  
   session()->flash('add');
   return redirect()->route('sections.index'); 

}

public function update($request) 
{
   $section =Section::findOrFail($request->id);
   $section->update(
      [  
     
          'name'=> $request ->input('name'), 
         ]);  
         session()->flash('edit');
         return redirect()->route('sections.index'); 
}
public function destroy($request)
{
   Section::findOrFail($request->id)->delete();
   session()->flash('delete');//message allert 
   return redirect()->route('sections.index');
}
   
public function show($id)
{
   // we have defferent methods to get the doctors that they in section 
   #first we can get them by this way 
  // $doctors = Doctor::all()->where('section_id',$id); 
  /**
   * foreach($doctors as doctor)
   * {
   * return doctor->name;}
   */

  #secound way
  // because the realation between them is 1 to many 
   $doctors=Section::findorfail($id)->doctors;//return the doctors that involved with this section (method from section controller)
   $section =Section::findorfail($id);
   return view('Dashboard.Sections.show_doctors',compact(['doctors','section']));
}
}
// we will make a new provider by name repositoryServiceProvider 