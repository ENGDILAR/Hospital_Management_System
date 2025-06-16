<?php

namespace Database\Seeders;

use App\Models\appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB ;

class appointmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('appointments')->delete();
        $appointments=[
      
        ['name' => 'السبت'],
        ['name' => 'الاحد'],
        ['name' => 'الاثنين'],
        ['name' => 'الثلاثاء'],
        ['name' => 'الاربعاء'],
        ['name' => 'الخميس'],
        ['name' => 'الجمعة'],
        ];
        foreach ($appointments as $appointment) {
            appointment::create($appointment);
        }

    }
}
