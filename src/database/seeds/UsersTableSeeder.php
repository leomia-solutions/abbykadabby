<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use Ramsey\Uuid\Uuid;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/** @var \Faker\Generator */
    	$faker = Faker\Factory::create();

    	DB::table('users')->insert(
            [
            	'id'         => Uuid::uuid3(Uuid::NAMESPACE_DNS, 'php.net')->toString(),
                'first_name' => $faker->firstName, 
                'last_name'  => $faker->lastName,
                'email'      => $faker->email,
                'password'   => app('hash')->make('somerandompassword'),
            ]
        );
    }
}
