<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
           return [
               'company_name' => $this->faker->company,
               'industry' => $this->faker->word,
               'description' => $this->faker->paragraph,
               'location' => $this->faker->address,
               'website' => $this->faker->url,
               'phone' => $this->faker->phoneNumber,
               'logo' => $this->faker->imageUrl(200, 200, 'business', true, 'Faker'),
           ];
    }
}
