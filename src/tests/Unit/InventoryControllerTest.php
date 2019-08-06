<?php

namespace Tests\Unit;

use App\Http\Requests\Inventory\CreateRequest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InventoryControllerTest extends TestCase
{
    /** @var string */
    private $class = 'InventroryController';

    /**
     * @covers \App\Http\Controllers\InventoryController::list()
     *
     * @return void
     */
    public function testList()
    {
        $this->describe($this->class.'::list()', function () {
            $this->describe('when there is at least one inventory record', function () {
                $this->should('return a 200 response with the inventory list view', function () {
                    $response = $this->get(route('inventoryList'));

                    $response->assertStatus(200);
                });
            });
        });
    }

    /**
     * @covers \App\Http\Controllers\InventoryController::create()
     *
     * @return void
     */
    public function testCreate()
    {
        $this->describe($this->class.'::create()', function () {
            $this->describe('with an anonymous user', function () {
                $this->should('send the user through the login flow', function () {
                    $response = $this->post(route('inventoryCreate'));

                    $response->assertStatus(300);
                });
            });

            $this->describe('with missing fields in the request', function () {
                $this->should('redirect the user to the inventory creation form with the data that was originally passed in', function ($description, $quantity, $units, $price) {
                    $response = $this->post(route('inventoryCreate', [
                        'descrption' => $description,
                        'quantity' => $quantity,
                        'units' => $units,
                        'price_per_unit' => $price,
                    ]));

                    $response->assertStatus(300);
                }, [
                    'examples' => [
                        [null, 1, 'lbs', 1.23],
                        ['tomatoes', null, 'lbs', 1.23],
                        ['tomatoes', 1, null, 1.23],
                        ['tomatoes', 1, 'lbs', null],
                    ],
                ]);
            });

            $this->describe('with invalid inputs', function () {
                $this->should('redirect the user to the inventory creation form with the data that was originally passed in, along with error messages', function ($description, $quantity, $units, $price) {
                    $response = $this->post(route('inventoryCreate', [
                        'descrption' => $description,
                        'quantity' => $quantity,
                        'units' => $units,
                        'price_per_unit' => $price,
                    ]));

                    $response->assertStatus(300);
                }, [
                    'examples' => [
                        ['tomatoes', 'string', 'lbs', 1.23],
                        ['tomatoes', 1.23, 'lbs', 1.23],
                        ['tomatoes', 1, 'lb', 1.23],
                        ['tomatoes', 1, 1, 1.23],
                        ['tomatoes', 1, 'lbs', -1],
                    ],
                ]);
            });

            $this->describe('with a valid request', function () {
                $this->should('redirect the user to the list page', function () {
                    $response = $this->post(route('inventoryCreate', [
                        'descrption' => 'tomatoes',
                        'quantity' => 3,
                        'units' => 'lbs',
                        'price_per_unit' => .69,
                    ]));

                    $response->assertStatus(201);
                });
            });
        });
    }
}
