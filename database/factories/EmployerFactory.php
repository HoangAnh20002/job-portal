<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\PostJob;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $companyId = 1;

        return [
            'user_id' => User::factory()->create(['role_id' => 2]),
            'company_id' =>Company::factory()->create(),
            'contact_info' => $this->faker->phoneNumber,
        ];
    }
}
