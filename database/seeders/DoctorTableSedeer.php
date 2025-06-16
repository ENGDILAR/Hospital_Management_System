<?php

namespace Database\Seeders;

use App\Models\appointment;
use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DoctorTableSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //go to doctor model and excute the factory that we have create it 

      Doctor::factory()->count(5)->create();// create 30 doctor 
       $appointments= appointment::all();// go to appoinmnet table and get all of them 
       Doctor::all()->each(function ($doctor) use ($appointments)// get all of the doctor an for each one make the fun 
       {
              //for each doctor excute the function named doctorappointments (many to many relation ship)
          $doctor->doctorappointments()->attach(
            //attach: is a function that take the both id of doctor and appointment an attach it inside doct_appointment table 

            $appointments->random(rand(1,7))->pluck('id')->toArray()

          );

          
       });
    }
}
