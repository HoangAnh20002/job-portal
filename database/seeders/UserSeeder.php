<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->create(['role_id' => 1]);

        User::factory()->count(5)->create(['role_id' => 2]);

        User::factory()->count(10)->create(['role_id' => 3]);
    }
}
