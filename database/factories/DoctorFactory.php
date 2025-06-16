<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    //defin the model that wen will use the factory on it 
    protected $model = Doctor::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'email'=>$this->faker->unique()->safeEmail(),//create fake email 
           'email_verified_at'=>now(),
           'password'=>Hash::make('admin12345'),//hashed
           'phone'=>$this->faker->phoneNumber(),
           'name'=>$this->faker->name,
          'section_id'=>Section::all()->random()->id,
                ];
    }
}
// php artisan mi:f --seed
// by this command we delete all the table content and rerun the seedres
// note: we dosenot have a columon called name or appoinents in this table but when we added it here 
// it has been added into the table in db