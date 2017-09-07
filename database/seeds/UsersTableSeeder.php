<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'name' => 'Fares',
            'email' => 'fares@fares.com',
            'password' => bcrypt('fares1978'),
            'admin'=> 1
        ]);

        App\Profile::create([
            'user_id' => $user->id,
            'about' => 'text about the user goes here! this is a dummy text',
            'facebook' => 'fares_facebook',
            'youtube' => 'fares_youtube',
            'avatar' => 'uploads/users/user.png',
        ]);
    }
}
