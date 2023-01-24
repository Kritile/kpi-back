<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->text(20),
            'description'=>fake()->text(350),
            'teacher_id'=>User::all()->random()->id,
            'image' => fake()->imageUrl('1440','500','cats'),
            'fullText' => fake()->text(1200),
        ];
    }
}
