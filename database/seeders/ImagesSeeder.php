<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Apartment;
use App\Models\Image; 

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param  Faker  $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments = Apartment::all();

        foreach ($apartments as $apartment) {

            $numPhotos = $faker->numberBetween(3, 9);

            for ($i = 0; $i < $numPhotos; $i++) {
                $photo = new image();
                $photo->apartment_id = $apartment->id;
                $photo->image = $faker->imageUrl(); 
                $photo->save();
            }
        }
    }
}
