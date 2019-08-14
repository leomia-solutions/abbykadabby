<?php

use Illuminate\Database\Seeder;

use App\Inventory;
use App\User;
use Faker\Factory;

class InventorySeeder extends Seeder
{
	protected $veggies = [
                'green bell peppers',
                'red bell peppers',
                'yellow bell peppers',
                'jalapeño peppers',
                'yellow tomatoes',
                'tomatoes',
                'parsely',
                'basil',
                'thyme',
                'sage',
            ];
    protected $units = ['lb', 'kg', 'ea'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventory')->truncate();

        $faker = Factory::create();
        $user = User::first();

        foreach ($this->veggies as $veggie) {
        	Inventory::create([
        		'description' => $veggie,
        		'weight' => $faker->randomFloat(2, 0, 100),
        		'weight_units' => $this->units[$faker->numberBetween(0,1)],
        		'quantity' => $faker->numberBetween(0, 100),
        		'price' => $faker->randomFloat(2, 0, 10),
        		'price_units' => $this->units[$faker->numberBetween(0,2)],
        		'user_id' => $user->id,
        	]);
        }
    }
}
