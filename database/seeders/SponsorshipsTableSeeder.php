<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsorship;


class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newSponsor1= new Sponsorship();
        $newSponsor1 -> type = 'one day';
        $newSponsor1 -> price = 2.99;
        $newSponsor1 -> time = 24;
        $newSponsor1->save();

        $newSponsor2= new Sponsorship();
        $newSponsor2 -> type = 'three days';
        $newSponsor2 -> price = 5.99;
        $newSponsor2 -> time = 72;
        $newSponsor2->save();

        $newSponsor3= new Sponsorship();
        $newSponsor3 -> type = 'one week';
        $newSponsor3 -> price = 9.99;
        $newSponsor3 -> time = 144;
        $newSponsor3->save();
        
    }
}
