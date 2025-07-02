<?php

use App\Http\Controllers\LabEmployee_Dashboard\InvoiceController;
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


 /////////////////### Lab dashboard ###///////////////////////
 Route::get('/dashboard/Lab', function () {
    return view('Dashboard.dashboard_LaboratorieEmployee.dashboard');
})->middleware(['auth', 'verified','lab'])->name('dashboard.lab');

  Route::middleware(['auth','verified','lab'])->group(function(){

      Route::resource('invoices_laboratorie_employee', InvoiceController::class);
     Route::get('Lab/completed_invoices', [InvoiceController::class,'completed_invoices'])->name('Lab.completed_invoices');
     Route::get('view_laboratories/{id}', [InvoiceController::class,'view_laboratories'])->name('Lab.view_laboratories');
       
       
       });
require __DIR__.'/auth.php';

});






