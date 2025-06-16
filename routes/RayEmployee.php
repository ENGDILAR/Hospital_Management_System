<?php

use App\Http\Controllers\RayEmployee_Dashboard\InvoiceController;
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


 /////////////////### Ray dashboard ###///////////////////////
 Route::get('/dashboard/ray', function () {
    return view('Dashboard.dashboard_RayEmployee.dashboard');
})->middleware(['auth', 'verified','ray'])->name('dashboard.user');

  Route::middleware(['auth','verified','ray'])->group(function(){

    
   //############################# invoices route ##########################################
    Route::resource('invoices_ray_employee', InvoiceController::class);
    Route::get('completed_invoices', [InvoiceController::class,'completed_invoices'])->name('completed_invoices');
    Route::get('view_rays/{id}', [InvoiceController::class,'viewRays'])->name('view_rays');
    

 //############################# end invoices route ######################################
       
       
       });
require __DIR__.'/auth.php';

});






