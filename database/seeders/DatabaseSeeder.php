<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
      $this->call(userseeder::class);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call(appointmentTableSeeder::class);// 0
        $this->call(SectionTableseeder::class);// 1
        $this->call(DoctorTableSedeer::class);//2
        $this->call(imagetableseeder::class);//3
       

    }
}
