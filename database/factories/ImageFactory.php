<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ImageFactory extends Factory
{
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'filename'=>$this->faker->randomElement(['1.jpg','2.jpg','3.jpg','4.jpg']),
          'imageable_id'=>Doctor::all()->random()->id,// get all idies from table Doctor and return a random value to give him a image
          'imageable_type'=>'App\Models\Doctor',// user type
        ];
    }
}
