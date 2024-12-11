<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Barber;
use App\Models\Service;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        // Seed 10 appointments with random data
        foreach (range(1, 10) as $index) {
            $appointment = Appointment::create([
                'status' => 'pending',  // Default status is 'pending'
                'appointment_date' => $faker->date,
                'appointment_time' => $faker->time,
                'full_name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'barber_id' => Barber::inRandomOrder()->first()->id,  // Random barber
            ]);

            // Attach random services to the appointment
            $appointment->services()->attach(Service::inRandomOrder()->first()->id);
        }
    }
}
