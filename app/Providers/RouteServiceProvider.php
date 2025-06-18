<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME='/dashboard/user';
    public const Admin='/dashboard/admin';
    public const Doctor='/dashboard/doctor';
    public const Ray='/dashboard/ray';
    public const Lab='/dashboard/Lab';
    /**
     * المسار الأساسي للصفحات.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * قم بتسجيل المسارات.
     *
     * @return void
     */
    public function boot()
    {
        $this->routes(function () {
        

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Backend.php'));


                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/doctor.php'));


                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/RayEmployee.php'));

                
                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/LabEmployee.php'));

                
                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Patient.php'));
        });
    }
}