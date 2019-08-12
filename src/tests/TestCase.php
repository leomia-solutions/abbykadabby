<?php

namespace Tests;

use App\Inventory;
use App\User;
use Codeception\Specify;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions, Specify;

    /** @var string */
    protected $class;

    /** @var App\User */
    protected $defaultUser;

    /** @var \Faker\Generator */
    protected $faker;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();

        $this->setUpBaseModels();
    }

    /**
     * Sets up the basic models needed for most tests
     */
    public function setUpBaseModels()
    {
        $this->defaultUser = $this->createUser();
    }

    public function responseData($response)
    {
        $data = json_decode($response->getContent(), true);

        return $data['data'];
    }

    /**
     * Creates a basic User
     *
     * @param array $params
     *
     * @return \App\User
     */
    public function createUser(array $params = []): User
    {
        return User::create(array_merge([
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'api_token' => Str::random(60),
        ], $params));
    }

    /**
     * Creates an inventory item
     *
     * @param array $params
     *
     * @return \App\Inventory
     */
    public function createInventoryItem(array $params = []): Inventory
    {
        return Inventory::create(array_merge([
            'description' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(0, 100),
            'weight' => $this->faker->randomFloat(2, 0, 5),
            'weight_units' => 'lb',
            'price' => $this->faker->randomFloat(2, 0, 20),
            'price_units' => 'lb',
        ], $params));
    }
}
