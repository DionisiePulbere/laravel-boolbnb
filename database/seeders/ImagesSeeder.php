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
        // $apartments = Apartment::all();

        // foreach ($apartments as $apartment) {

        //     $numPhotos = $faker->numberBetween(3, 9);

        //     for ($i = 0; $i < $numPhotos; $i++) {
        //         $photo = new image();
        //         $photo->apartment_id = $apartment->id;
        //         $photo->image = $faker->imageUrl(); 
        //         $photo->save();
        //     }
        // }
        $photo11 = new Image();
        $photo11->apartment_id = 1;
        $photo11->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-956228322388039322/original/03dc4bd0-5bc4-4ac7-b114-39797c177b9c.jpeg?im_w=720'; 
        $photo11->save();

        $photo12 = new Image();
        $photo12->apartment_id = 1;
        $photo12->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-956228322388039322/original/0c89cc99-93e6-4f5f-b26a-ef9bd8da011f.jpeg?im_w=720'; 
        $photo12->save();

        $photo13 = new Image();
        $photo13->apartment_id = 1;
        $photo13->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-956228322388039322/original/314527a9-7f92-4cad-b0dd-0cf409ee946a.jpeg?im_w=720'; 
        $photo13->save();

        $photo14 = new Image();
        $photo14->apartment_id = 1;
        $photo14->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-956228322388039322/original/e232270d-6085-4ac5-bc66-75c0147227b1.jpeg?im_w=720'; 
        $photo14->save();

        $photo21 = new Image();
        $photo21->apartment_id = 2;
        $photo21->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-933794710674073616/original/9e552ca1-ce82-42eb-a783-82f93fdd2b0b.jpeg?im_w=720'; 
        $photo21->save();

        $photo21 = new Image();
        $photo21->apartment_id = 2;
        $photo21->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-933794710674073616/original/21964d93-931e-43f2-9319-73c4c1370b77.jpeg?im_w=720'; 
        $photo21->save();
        
        $photo21 = new Image();
        $photo21->apartment_id = 2;
        $photo21->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-933794710674073616/original/0e120813-32ab-4dbe-92de-66d345bed5e0.jpeg?im_w=720'; 
        $photo21->save();

        $photo21 = new Image();
        $photo21->apartment_id = 2;
        $photo21->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-933794710674073616/original/d747e6e1-8612-481a-8fa9-18cd8aa689a1.jpeg?im_w=720'; 
        $photo21->save();

        $photo31 = new Image();
        $photo31->apartment_id = 3;
        $photo31->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-1102227215773470197/original/fafc25c0-6250-448b-8a78-4ecf982d3969.jpeg?im_w=720'; 
        $photo31->save();

        $photo32 = new Image();
        $photo32->apartment_id = 3;
        $photo32->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-1102227215773470197/original/461f11ed-5894-404c-93ea-b2e70259c1b7.jpeg?im_w=720'; 
        $photo32->save();
        
        $photo33 = new Image();
        $photo33->apartment_id = 3;
        $photo33->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-1102227215773470197/original/35462a5a-cfc7-4fad-82c8-10ff59ede63f.jpeg?im_w=720'; 
        $photo33->save();

        $photo34 = new Image();
        $photo34->apartment_id = 3;
        $photo34->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-1102227215773470197/original/84026c04-398d-4f4c-8e86-3c55a179ad84.jpeg?im_w=720'; 
        $photo34->save();

        $photo41 = new Image();
        $photo41->apartment_id = 4;
        $photo41->image = 'https://a0.muscache.com/im/pictures/hosting/Hosting-U3RheVN1cHBseUxpc3Rpbmc6MTE4MTgzMTcxNzY3MjA0NDIzMw%3D%3D/original/9992c497-2795-4cd8-a0b7-d6084d37f016.jpeg?im_w=720'; 
        $photo41->save();

        $photo42 = new Image();
        $photo42->apartment_id = 4;
        $photo42->image = 'https://a0.muscache.com/im/pictures/hosting/Hosting-U3RheVN1cHBseUxpc3Rpbmc6MTE4MTgzMTcxNzY3MjA0NDIzMw%3D%3D/original/f906b52b-d28a-443b-bce9-8c60e50f1f9e.jpeg?im_w=720'; 
        $photo42->save();
        
        $photo43 = new Image();
        $photo43->apartment_id = 4;
        $photo43->image = 'https://a0.muscache.com/im/pictures/hosting/Hosting-U3RheVN1cHBseUxpc3Rpbmc6MTE4MTgzMTcxNzY3MjA0NDIzMw%3D%3D/original/e94e970b-8239-4e8c-94ec-e3be22865732.jpeg?im_w=720'; 
        $photo43->save();

        $photo44 = new Image();
        $photo44->apartment_id = 4;
        $photo44->image = 'https://a0.muscache.com/im/pictures/hosting/Hosting-U3RheVN1cHBseUxpc3Rpbmc6MTE4MTgzMTcxNzY3MjA0NDIzMw%3D%3D/original/91a999db-a49b-4043-8fe1-78016c699089.jpeg?im_w=720'; 
        $photo44->save();

        $photo51 = new Image();
        $photo51->apartment_id = 5;
        $photo51->image = 'https://a0.muscache.com/im/pictures/prohost-api/Hosting-1092617355496270460/original/e9773c0d-4390-4e43-b4ed-63cb170a1aa5.jpeg?im_w=720'; 
        $photo51->save();

        $photo52 = new Image();
        $photo52->apartment_id = 5;
        $photo52->image = 'https://a0.muscache.com/im/pictures/prohost-api/Hosting-1092617355496270460/original/bd2da2ff-e04f-4f78-93a7-c6baceb67dc5.jpeg?im_w=720'; 
        $photo52->save();
        
        $photo53 = new Image();
        $photo53->apartment_id = 5;
        $photo53->image = 'https://a0.muscache.com/im/pictures/prohost-api/Hosting-1092617355496270460/original/da8d0439-adfa-441c-a75c-0159259f761d.jpeg?im_w=720'; 
        $photo53->save();

        $photo54 = new Image();
        $photo54->apartment_id = 5;
        $photo54->image = 'https://a0.muscache.com/im/pictures/prohost-api/Hosting-1092617355496270460/original/752280b0-8fad-475f-bf28-ddf65808f351.jpeg?im_w=720'; 
        $photo54->save();

        $photo61 = new Image();
        $photo61->apartment_id = 6;
        $photo61->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-909162726572829721/original/e2e8134a-4ae9-4e2f-bf1c-7def1436b184.jpeg?im_w=720'; 
        $photo61->save();

        $photo62 = new Image();
        $photo62->apartment_id = 6;
        $photo62->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-909162726572829721/original/98358243-e45f-4066-a331-408812ff638a.jpeg?im_w=720'; 
        $photo62->save();
        
        $photo63 = new Image();
        $photo63->apartment_id = 6;
        $photo63->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-909162726572829721/original/7c189fdd-8afc-48ef-9cb1-71fde6aad1ac.jpeg?im_w=720'; 
        $photo63->save();

        $photo64 = new Image();
        $photo64->apartment_id = 6;
        $photo64->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-909162726572829721/original/b4cb26e9-8213-46aa-9f20-ef7788e4e378.jpeg?im_w=720'; 
        $photo64->save();

        $photo71 = new Image();
        $photo71->apartment_id = 7;
        $photo71->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-1130332951551440501/original/17b918e2-b994-4ce1-8449-9443759aaab1.jpeg?im_w=720'; 
        $photo71->save();

        $photo72 = new Image();
        $photo72->apartment_id = 7;
        $photo72->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-1130332951551440501/original/6c99a70b-0f85-4a5b-b06c-706a627deb6c.jpeg?im_w=720'; 
        $photo72->save();
        
        $photo73 = new Image();
        $photo73->apartment_id = 7;
        $photo73->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-1130332951551440501/original/da395c64-bf31-4ba0-9469-1437eca3c3a0.jpeg?im_w=720'; 
        $photo73->save();

        $photo74 = new Image();
        $photo74->apartment_id = 7;
        $photo74->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-1130332951551440501/original/2ed78b51-ddf1-40ce-ba1b-59f9028127dd.jpeg?im_w=720'; 
        $photo74->save();

        $photo81 = new Image();
        $photo81->apartment_id = 8;
        $photo81->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-933794710674073616/original/9e552ca1-ce82-42eb-a783-82f93fdd2b0b.jpeg?im_w=720'; 
        $photo81->save();

        $photo82 = new Image();
        $photo82->apartment_id = 8;
        $photo82->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-933794710674073616/original/21964d93-931e-43f2-9319-73c4c1370b77.jpeg?im_w=720'; 
        $photo82->save();
        
        $photo83 = new Image();
        $photo83->apartment_id = 8;
        $photo83->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-933794710674073616/original/0e120813-32ab-4dbe-92de-66d345bed5e0.jpeg?im_w=720'; 
        $photo83->save();

        $photo84 = new Image();
        $photo84->apartment_id = 8;
        $photo84->image = 'https://a0.muscache.com/im/pictures/miso/Hosting-933794710674073616/original/d747e6e1-8612-481a-8fa9-18cd8aa689a1.jpeg?im_w=720'; 
        $photo84->save();

        $photo91 = new Image();
        $photo91->apartment_id = 9;
        $photo91->image = 'https://a0.muscache.com/im/pictures/69544009/539f37f3_original.jpg?im_w=720'; 
        $photo91->save();

        $photo92 = new Image();
        $photo92->apartment_id = 9;
        $photo92->image = 'https://a0.muscache.com/im/pictures/69543881/62d8409d_original.jpg?im_w=720'; 
        $photo92->save();
        
        $photo93 = new Image();
        $photo93->apartment_id = 9;
        $photo93->image = 'https://a0.muscache.com/im/pictures/70198346/830f3529_original.jpg?im_w=720'; 
        $photo93->save();

        $photo94 = new Image();
        $photo94->apartment_id = 9;
        $photo94->image = 'https://a0.muscache.com/im/pictures/84577347/6aabc58c_original.jpg?im_w=720'; 
        $photo94->save();

        $photo = new Image();
        $photo->apartment_id = 1;
        $photo->image = ''; 
        $photo->save();

        $photo = new Image();
        $photo->apartment_id = 1;
        $photo->image = ''; 
        $photo->save();
        
        $photo = new Image();
        $photo->apartment_id = 1;
        $photo->image = ''; 
        $photo->save();

        $photo = new Image();
        $photo->apartment_id = 1;
        $photo->image = ''; 
        $photo->save();

        $photo = new Image();
        $photo->apartment_id = 1;
        $photo->image = ''; 
        $photo->save();

        $photo = new Image();
        $photo->apartment_id = 1;
        $photo->image = ''; 
        $photo->save();
        
        $photo = new Image();
        $photo->apartment_id = 1;
        $photo->image = ''; 
        $photo->save();

        $photo = new Image();
        $photo->apartment_id = 1;
        $photo->image = ''; 
        $photo->save();

    }
}
