<?php

namespace Tests\Unit;

use App\Services\InventoryService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryServiceTest extends TestCase
{
	/**
	 * @var \App\Services\InventoryService
	 * @specify
	 */
	protected $service;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSearch()
    {
    	$this->beforeSpecify(function () {
    		$this->service = app(InventoryService::class);

    		foreach (range(0,10) as $i) {
    			$this->createInventoryItem();
    		}
    	});

    	$this->describe('InventoryService::search', function () {
    		$this->describe('passed an empty string', function () {
    			$this->should('return an empty collection', function () {

    			});
    		});

    		$this->describe('passed a string with a single term', function () {
    			$this->should('return records containing the term as a substring', function () {

    			});
    		});

    		$this->describe('passed a string with multiple search terms', function () {
    			$this->should('return records containing all of the search terms as substrings', function() {

    			});
    		});
    	});
    }
}
