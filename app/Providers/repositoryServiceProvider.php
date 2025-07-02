<?php

namespace App\Providers;

use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use App\interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\interfaces\doctor_dashboard\LaboratoriesRepositoryInterface;
use App\interfaces\doctor_dashboard\RaysRepositoryInterface;
use App\interfaces\Doctors\DoctorRepositoryInterface;
use App\interfaces\Finance\PaymentRepositoryInterface;
use App\interfaces\Finance\ReceiptRepositoryInterface;
use App\interfaces\insurance\insuranceRepositoryInterface;
use App\interfaces\LabEmployee\LabEmployeeRepositoryInterface;
use App\interfaces\LabEmployee_Dashboard\InvoicesRepositoryInterface as LabEmployee_DashboardInvoicesRepositoryInterface;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\interfaces\RayEmployee_Dashboard\InvoicesRepositoryInterface as REInvoicesRepositoryInterface;
use App\interfaces\sections\SectionRepositoryInterface;
use App\interfaces\services\singleservicerepositoryinterface;
use App\Repository\Ambulances\AmbulanceRepository;
use App\repository\doctor_dashboard\DiagnosisRepository;
use App\repository\doctor_dashboard\InvoicesRepository;
use App\repository\doctor_dashboard\LaboratoriesRepository;
use App\repository\doctor_dashboard\RaysRepository;
use App\repository\sections\SectionRepository;
use Illuminate\Support\ServiceProvider;
use App\repository\Doctors\DoctorRepository;
use App\repository\Finance\PaymentRepository;
use App\repository\Finance\ReceiptRepository;
use App\repository\insurance\insuranceRepository;
use App\repository\LabEmployee_Dashboard\InvoicesRepository as LabEmployee_DashboardInvoicesRepository;
use App\repository\LaboratorieEmployee\LaboratorieEmployeeRepository;
use App\Repository\Patients\PatientRepository;
use App\repository\RayEmployee\RayEmployeeRepository;
use App\repository\RayEmployee_Dashboard\InvoicesRepository as REInvoicesRepository;
use App\repository\services\singleservicerepository;

class repositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // we should bind the interfaface and the repository in the registration of the provider that belong to them

        ######################### Admin ##############################################
        $this->app->bind(SectionRepositoryInterface::class,SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class,DoctorRepository::class);
        $this->app->bind(singleservicerepositoryinterface::class,singleservicerepository::class);
        $this->app->bind(insuranceRepositoryInterface::class,insuranceRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class, AmbulanceRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(ReceiptRepositoryInterface::class,ReceiptRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class,PaymentRepository::class);
        $this->app->bind(RayEmployeeRepositoryInterface::class,RayEmployeeRepository::class);
        $this->app->bind(LabEmployeeRepositoryInterface::class,LaboratorieEmployeeRepository::class);


             ######################### Doctor ##############################################
        $this->app->bind(InvoicesRepositoryInterface::class,InvoicesRepository::class);
        $this->app->bind(DiagnosisRepositoryInterface::class,DiagnosisRepository::class);
        $this->app->bind(RaysRepositoryInterface::class,RaysRepository::class);
        $this->app->bind(LaboratoriesRepositoryInterface::class,LaboratoriesRepository::class);

             
             ######################### Ray Employee ##############################################

        $this->app->bind(REInvoicesRepositoryInterface::class,REInvoicesRepository::class);

             
             ######################### Lab Employee ##############################################

             $this->app->bind(LabEmployee_DashboardInvoicesRepositoryInterface::class,LabEmployee_DashboardInvoicesRepository::class);

             
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
