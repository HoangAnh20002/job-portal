<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostJob>
 */
class PostJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'job_title' => $this->faker->jobTitle,
            'job_description' => $this->faker->paragraph,
            'service_id'=>1,
            'job_requirement' => $this->faker->text,
            'employer_id' => Employer::inRandomOrder()->first()->id,
            'salary' => $this->faker->randomFloat(2, 30000, 100000),
            'employment_type' => $this->faker->randomElement([1,2,3]),
            'post_date' => $this->faker->date,
            'expiration_date' => $this->faker->date,
            'status' => $this->faker->randomElement([1, 2]),
        ];
    }
}
