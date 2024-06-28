<?php

namespace Database\Seeders;
use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class apartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i<10 ; $i++){
            $newApartment = new Apartment();
            $newApartment->user_id = 1;
            $newApartment->title = $faker->sentence(3);
            $newApartment->slug = Str::slug($newApartment->title, '-');
            $newApartment->visibility = 0;
            $newApartment->thumb = 'https://picsum.photos/200/300';
            $newApartment->description = $faker->sentence(10);
            $newApartment->price =$faker->randomFloat(2, 100, 999) ;
            $newApartment->number_of_room =$faker->randomDigit;
            $newApartment->number_of_bed =$faker->randomDigit;
            $newApartment->number_of_bath =$faker->randomDigit;
            $newApartment->square_meters =$faker->numberBetween(50, 250);
            $newApartment->latitude =$faker->latitude($min = -90, $max = 90);
            $newApartment->longitude =$faker->longitude($min = -90, $max = 90);
            $newApartment->address =$faker->streetAddress();
            $newApartment->save();
        }
    }
}
