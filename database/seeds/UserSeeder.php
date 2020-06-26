<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 40; $i++) {
            $user = new \App\User;
            $user->first_name = Str::random(10);
            $user->last_name = Str::random(10);
            $user->email = Str::random(10).'@gmail.com';
            $user->password = Hash::make('password');
            $user->save();
        }
    }
}
