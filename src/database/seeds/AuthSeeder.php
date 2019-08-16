<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('oauth_clients')->truncate();

    	$client = config('auth.clients.default');

        DB::table('oauth_clients')->insert([
        	'name' => $client['name'],
        	'secret' => $client['secret'],
        	'redirect' => $client['redirect'],
        	'personal_access_client' => $client['personal_access_client'],
        	'password_client' => $client['password_client'],
        	'revoked' => $client['revoked'],
        ]);
    }
}
