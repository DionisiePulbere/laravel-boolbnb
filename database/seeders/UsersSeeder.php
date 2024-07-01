<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newUser = new User();
        $newUser->name = 'Host';
        $newUser->surname = 'Prova';
        $newUser->email = 'ciao@ciao.it';
        $newUser->date_of_birth = '2000-02-26'; 
        $newUser->password = bcrypt('ciaociao');

        $newUser->save(); 
    }
}
