<?php

namespace Database\Seeders;

use App\Models\Service;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        // Create 5 services as an example
        foreach (range(1, 5) as $index) {
            Service::create([
                'name' => $faker->word,
                'status' => 'available',
            ]);
        }
    }
}
