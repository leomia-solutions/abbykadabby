<?php

namespace Tests;

use App\Inventory;
use App\User;
use Codeception\Specify;
use Faker\Generator;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, Specify;

    /** @var App\User */
    protected $defaultUser;

    /** @var \Faker\Generator */
    protected $faker;

    public function setUp(): void
    {
        $this->faker = new Faker\Generator();

        $this->setUpBaseModels();

        parent::setUp();
    }

    /**
     * Sets up the basic models needed for most tests
     */
    public function setUpBaseModels()
    {
        $this->defaultUser = $this->createUser();
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
            // todo
        ], $params));
    }

    /**
     * Creates an inventory item
     * 
     * @param array $params
     * 
     * @return \App\Inventory
     */
    public function createInventoryItem(array $params = []): createInventoryItem
    {
        return Inventory::create(array_merge([
            'description' => $this->faker->word,
            'quantity' => $this->faker->integer,
            'weight' => $this->faker->float,
            'weight_units' => 'lb',
            'price' => $this->faker->price,
            'price_units' => 'lb',
        ], $params));
    }
}
