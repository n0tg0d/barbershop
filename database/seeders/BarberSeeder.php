<?php

namespace Database\Seeders;

use App\Models\Barber;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class BarberSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        // Create 10 barbers as an example
        foreach (range(1, 10) as $index) {
            Barber::create([
                'name' => $faker->name,
                'status' => 'available', 
            ]);
        }
    }
}
