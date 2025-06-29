<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    protected $model = Section::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
       'name'=>$this->faker->unique()->randomElement(['قسم الجراحة','قسم الاطفال','قسم التوليد','قسم الاسعاف','قسم العناية']),
       'description'=>$this->faker->paragraph,// add afake long text to testing 
        ];
    }
}
