<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
   //  DB::table('users')->truncate();   
        User::create([
            'name' => 'Dilar',
            'email' => 'diloalmmio@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user',
        ]);
        // إنشاء دكتور
        User::create([
            'name' => 'Doctor',
            'email' => 'doctor@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'doctor',
        ]);

        // إنشاء أدمين
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
    }
}
