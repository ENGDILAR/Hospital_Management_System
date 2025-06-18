<?php

use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\dashboard\doctorcontroller;
use App\Http\Controllers\dashboard\sectioncontroller;
use App\Http\Controllers\dashboard\InsuranceController;
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


Route::middleware(['auth','verified','user'])->group(function(){
Route::get('/dashboard/user', function () {
    return view('Dashboard.user.dashboard');
})->name('dashboard.user');


/*   //############################# patients route ##########################################
        Route::get('invoices', [PatientController::class,'invoices'])->name('invoices.patient');
        Route::get('laboratories', [PatientController::class,'laboratories'])->name('laboratories.patient');
        Route::get('view_laboratories/{id}', [PatientController::class,'viewLaboratories'])->name('laboratories.view');
        Route::get('rays', [PatientController::class,'rays'])->name('rays.patient');
        Route::get('view_rays/{id}', [PatientController::class,'viewRays'])->name('rays.view');
        Route::get('payments', [PatientController::class,'payments'])->name('payments.patient');
        //############################# end patients route ######################################*/



});



require __DIR__.'/auth.php';
});






