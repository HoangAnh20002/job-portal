<?php

namespace Database\Factories;

use App\Models\JobSeeker;
use App\Models\PostJob;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'postjob_id' => PostJob::inRandomOrder()->first()->id,
            'jobseeker_id' => JobSeeker::inRandomOrder()->first()->id,
            'application_date' => $this->faker->date,
            'application_status' => $this->faker->randomElement(['Accepted', 'Rejected']),
        ];
    }
}
