<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(EmployerSeeder::class);
        $this->call(PostJobSeeder::class);
        $this->call(JobSeekerSeeder::class);
        $this->call(ApplicationSeeder::class);       
        $this->call(PaymentSeeder::class);

    }
}
