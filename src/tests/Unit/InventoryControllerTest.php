<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InventoryControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testList()
    {
        $this->describe('::list()', function () {
            $this->describe('when there is at least one inventory record', function () {
                $this->should('return a 200 response with the inventory list view', function () {
                    $response = $this->get(route('inventoryList'));

                    $response->assertStatus(200);
                });
            });
        });
    }
}
