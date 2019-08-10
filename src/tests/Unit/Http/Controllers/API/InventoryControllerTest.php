<?php

namespace Tests\Unit\Http\Controllers\API;

use Facades\App\Services\InventoryService;
use Tests\TestCase;

class InventoryControllerTest extends TestCase
{
	/** @var string */
	protected $class = \App\Http\Controllers\API\InventoryController::class;

	public function testList()
	{ 
		$this->withoutExceptionHandling();

		$this->specify($this->class.'::list()', function () {
			$this->describe('with no parameters passed', function () {
				$this->should('return a paginated subset of inventory records', function () {
					InventoryService::shouldReceive('search')
						->with('')
						->passthru();

					$response = $this->get(route('apiInventoryList'));

					$response->assertStatus(200);

					$content = json_decode($response->getContent(), true);

					$this->assertArrayHasKey('data', $content);
					$this->assertArrayHasKey('links', $content);
					$this->assertArrayHasKey('meta', $content);
				});
			});

			$this->describe('filtered by description', function () {
				$this->should('return a paginated subset of inventory records matching the search terms', function () {
					InventoryService::shouldReceive('search')
						->with('term')
						->passthru();

					$response = $this->get(route('apiInventoryList', ['description_contains' => 'term']));

					$response->assertStatus(200);

					$content = json_decode($response->getContent(), true);

					$this->assertArrayHasKey('data', $content);
					$this->assertArrayHasKey('links', $content);
					$this->assertArrayHasKey('meta', $content);
				});
			});
		});
	}
}
