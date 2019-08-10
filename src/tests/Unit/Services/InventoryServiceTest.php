<?php

namespace Tests\Unit;

use App\Services\InventoryService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class InventoryServiceTest extends TestCase
{
    /** @var string */
    protected $class = 'InventoryService';
    /** @var \App\Services\InventoryService */
    protected $service;
    /** @var array */
    protected $inventoryDescriptions = [
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

    public function setUp(): void
    {
        parent::setUp();

        $this->service = app(InventoryService::class);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSearch(): void
    {
	    $this->afterSpecify(function () {
	        DB::table('inventory')->truncate();
	    });

        $this->specify($this->class.'::search', function () {
            $this->describe('passed an empty string', function () {
                $this->should('return an empty collection', function () {
			        $this->populateInventory();

                    $result = $this->service->search('');

                    $this->assertEmpty($result);
                });
            });

            $this->describe('passed a string with a single term', function () {
                $this->should('return records containing the term as a substring', function () {
			        $this->populateInventory();

                    $results = $this->service->search('pepper');

                    $this->assertEquals(4, $results->count());

                });
            });

            $this->describe('passed a string with multiple search terms', function () {
                $this->should('return records containing all of the search terms as substrings', function () {
			        $this->populateInventory();

			        $results = $this->service->search('yellow pepper');

			        $this->assertEquals(5, $results->count());

                    $expectedDescriptions = array_slice($this->inventoryDescriptions, 0, 5);
                    foreach ($results as $result) {
                        $this->assertContains($result->description_lower, $expectedDescriptions);
                    }
                });
            });
        });
    }

    protected function populateInventory(): void
    {
    	foreach ($this->inventoryDescriptions as $description) {
            $this->createInventoryItem(['description' => $description]);
        }
    }
}
