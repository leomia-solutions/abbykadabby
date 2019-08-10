<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;

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
        $this->specify($this->class.'::list()', function () {
            $this->describe('when there is at least one inventory record', function () {
                $this->should('return a 200 response with the inventory list view', function () {
                    $this->markTestIncomplete('test not implemented');
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
        $this->specify($this->class.'::create()', function () {
            $this->describe('with an anonymous user', function () {
                $this->should('send the user through the login flow', function () {
                    $this->markTestIncomplete('test not implemented');
                });
            });

            $this->describe('with missing fields in the request', function () {
                $this->should('redirect the user to the inventory creation form with the data that was originally passed in', function () {
                    $this->markTestIncomplete('test not implemented');
                });
            });

            $this->describe('with invalid inputs', function () {
                $this->should('redirect the user to the inventory creation form with the data that was originally passed in, along with error messages', function () {
                    $this->markTestIncomplete('test not implemented');
                });
            });

            $this->describe('with a valid request', function () {
                $this->should('redirect the user to the list page', function () {
                    $this->markTestIncomplete('test not implemented');
                });
            });
        });
    }
}
