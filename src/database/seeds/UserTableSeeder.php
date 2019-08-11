<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        User::create([
            'first_name' => 'Matt',
            'last_name' => 'Campo',
            'email'    => 'matt.campo@leomiasolutions.com',
            'password' => 'password',
            'api_token' => Str::random(60),
        ]);
    }
}
