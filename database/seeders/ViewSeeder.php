<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\View;
use App\Models\Apartment;
use Faker\Generator as Faker;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $Faker)
    {
        $apartments = Apartment::All();
        foreach ($apartments as $apartment) {
            for ($i=0; $i < 10; $i++) { 
                View::create([
                    'apartment_id' => $apartment->id,
                    'ip_address' => $Faker->ipv4,
                    'date_visit' => $Faker->dateTimeBetween('-1 week', 'now'),
                ]);
            }
        }
    }
}