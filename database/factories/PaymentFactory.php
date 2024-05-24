<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\PostJob;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'employer_id' => Employer::inRandomOrder()->first()->id,
            'amount' => $this->faker->randomFloat(2, 100, 1000),
            'payment_date' => $this->faker->date,
            'postjob_id' => PostJob::inRandomOrder()->first()->id,
            'service_id' => Service::inRandomOrder()->first()->id,
            'payment_status' => $this->faker->randomElement(['Pending', 'Completed', 'Failed']),
        ];
    }
}
