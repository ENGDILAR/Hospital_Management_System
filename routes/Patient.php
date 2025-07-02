<?php

use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\dashboard\doctorcontroller;
use App\Http\Controllers\dashboard\sectioncontroller;
use App\Http\Controllers\dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\ReceiptAccoutController;
use App\Http\Controllers\Dashboard_Patient\PatientDashboardController;
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


Route::middleware(['auth','verified','user'])->group(function(){
Route::get('/dashboard/user', function () {
    return view('Dashboard.user.dashboard');
})->name('dashboard.user');
        Route::get('Patient/Dashboard/invoices', [PatientDashboardController::class,'invoices'])->name('PatientDash.invoices');
        Route::get('Patient/Dashboard/laboratories', [PatientDashboardController::class,'laboratories'])->name('PatientDash.Laboratories');
        Route::get('Patient/Dashboard/view_laboratories/{id}', [PatientDashboardController::class,'viewLaboratories'])->name('PatientDash.Laboratories.view');
        Route::get('Patient/Dashboard/rays', [PatientDashboardController::class,'rays'])->name('PatientDash.rays');
        Route::get('Patient/Dashboard/view_rays/{id}', [PatientDashboardController::class,'viewRays'])->name('PatientDash.rays.view');
        Route::get('Patient/Dashboard/payments', [PatientDashboardController::class,'payments'])->name('PatientDash.payments');
});



require __DIR__.'/auth.php';
});






