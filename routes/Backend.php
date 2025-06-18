<?php

use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\dashboard\doctorcontroller;
use App\Http\Controllers\dashboard\sectioncontroller;
use App\Http\Controllers\dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\LaboratorieEmployeeController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\ReceiptAccoutController;
use App\Http\Controllers\singleservicecontroller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

//BACKEN ROUTES

//mcamara for get The package sets your application locale App::getLocale() according to your url. The locale may then be used for

/**
 *localeSessionRedirect ::when you close the dashboard on arabic lang this func make it arabic again when you re-oppened it
 * localizationRedirect make shore about redirect it 
 */
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 
        // $# the route bellow will be transleted $# 


// because of the conflict rout when we use mcamara pacakge
// if we didnot put it here we will get not found 404  v
Livewire::setUpdateRoute(function($handle){
return Route::post('/livewire/update',$handle);
});



//###################### admin routes  ##################

Route::get('/dashboard/admin', function () {
    return view('Dashboard.Admin.dashboard');
})->middleware(['auth', 'verified','admin'])->name('dashboard.admin');

Route::middleware(['auth','verified','admin'])->group(function(){

 // any user will use this routes should be an admin auth 
 Route::resource('sections',sectioncontroller::class);

 //###################### Doctor ######################
 Route::resource('Doctors',doctorcontroller::class);
 Route::post('update_password',[doctorcontroller::class,'update_password'])->name('update_pasword'); 
 Route::post('update_status',[doctorcontroller::class,'update_status'])->name('update_status');

 //###################### service  ##################
 Route::resource('services',singleservicecontroller::class);

 //###################### group service(livewire)  ##################

 Route::view('Add_GroupServices','livewire.GroupServices.include_create')->name('Add_GroupServices');

 //###################### insurance  ##################
 Route::resource('insurance',InsuranceController::class);

 //##################### Ambulance  ###################
 Route::resource('Ambulance',AmbulanceController::class);

 //##################### patient  ###################
 Route::resource('Patients', PatientController::class);


 //##################### Receipt  ###################
 Route::resource('Receipt', ReceiptAccoutController::class);


 //############################# single_invoices route ##########################################

 Route::view('single_invoices','livewire.single_invoices.index')->name('single_invoices');
 Route::view('Print_single_invoices','livewire.single_invoices.print')->name('Print_single_invoices');

 //##################### Payment  ###################Print_single_invoices
 Route::resource('Payment', PaymentAccountController::class);

 //############################# Group route ##########################################

 Route::view('group_invoices','livewire.Group_invoices.index')->name('group_invoices');
 Route::view('Print_group_invoices','livewire.group_invoices.print')->name('Print_group_invoices');


 Route::resource('ray_employee', RayEmployeeController::class);

 //############################# end RayEmployee route ######################################



 Route::resource('laboratorie_employee', LaboratorieEmployeeController::class);


});

###########################################################



/////////////////###  user dashboard ###///////////////////////
Route::get('/dashboard/user', function () {
    return view('Dashboard.user.dashboard');
})->middleware(['auth', 'verified','user'])->name('dashboard.user');



####################################################################








require __DIR__.'/auth.php';




});






