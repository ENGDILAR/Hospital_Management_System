<?php

use App\Http\Controllers\doctor\DiagnosticController;
use App\Http\Controllers\doctor\InvoiceController;
use App\Http\Controllers\doctor\LaboratorieController;
use App\Http\Controllers\doctor\PatientDetailesController;
use App\Http\Controllers\doctor\RayController;
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


 /////////////////###  Doctor dashboard ###///////////////////////
 Route::get('/dashboard/doctor', function () {
    return view('Dashboard.Doctor.dashboard');
 })->middleware(['auth', 'verified','doctor'])->name('dashboard.doctor');




 Route::middleware(['auth','verified','doctor'])->group(function(){

 // any user will use this routes should be an doctor auth 

      //############################# completed_invoices route ##########################################
     // Route::get('completed_invoices', [InvoiceController::class,'completedInvoices'])->name('completedInvoices');

      Route::get('doctor/completed_invoices',[InvoiceController::class,'completedInvoices'])->name('completedInvoicesForDoctor');
      //############################# review_invoices route ##########################################
      Route::get('rdoctor/eview_invoices', [InvoiceController::class,'reviewInvoices'])->name('reviewInvoices');
      


      Route::resource('doctor_invoices',InvoiceController::class);

 
      Route::resource('doctor_Diagnostics',DiagnosticController::class);

      Route::post('doctor/add_review', [DiagnosticController::class,'addReview'])->name('add_review');

      Route::resource('doctor_rays', RayController::class);

      Route::get('doctor/patient_details/{id}', [PatientDetailesController::class,'index'])->name('patient_details');


      Route::resource('doctor_Laboratories', LaboratorieController::class);
      Route::get('doctor/show_laboratorie/{id}', [InvoiceController::class,'showLaboratorie'])->name('show.laboratorie');

      
 


});

require __DIR__.'/auth.php';

});






