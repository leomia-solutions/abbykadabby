<?php

namespace Tests\Unit\Http\Controllers\API;

use App\Inventory;
use Facades\App\Services\InventoryService;
use Tests\TestCase;

class InventoryControllerTest extends TestCase
{
	/** @var string */
	protected $class = \App\Http\Controllers\API\InventoryController::class;

	public function testList()
	{ 
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

	public function testCreate()
	{
		$this->specify($this->class.'::create()', function () {
			$this->describe('when passed missing required parameters', function () {
				$this->should('return a 422', function ($unsetIndex) {
					$data = [
						'description' => 'description',
						'weight' => $this->faker->randomFloat(2, 0, 5),
						'weight_units' => 'lb',
						'price' => $this->faker->randomFloat(2, 0, 5),
						'price_units' => 'lb',
					];

					unset($data[$unsetIndex]);

					$response = $this->post(route('apiInventoryCreate', $data));

					$response->assertStatus(422);
				}, ['examples' => [
						['description'],
						['weight'],
						['weight_units'],
						['price'],
						['price_units'],
				]]);
			});

			$this->describe('with invalid parameters', function () {
				$this->should('return a 422', function ($description, $quantity, $weight, $weightUnits, $price, $priceUnits) {
					$response = $this->post(route('apiInventoryCreate'), [
						'description' => $description,
						'quantity' => $quantity,
						'weight' => $weight,
						'weight_units' => $weightUnits,
						'price' => $price,
						'priceUnits' => $priceUnits,
					]);

					$response->assertStatus(422);
				}, ['examples' => [
					[null, null, 1.23, 'lb', 1.23, 'ea'],
					['description', 'non-numeric', 1.23, 'lb', 1.23, 'ea'],
					['description', 1.23, 1.23, 'lb', 1.23, 'ea'],
					['description', 1, 'non-numeric', 'lb', 1.23, 'ea'],
					['description', 1, null, 'lb', 1.23, 'ea'],
					['description', 1, 1.23, 'oz', 1.23, 'ea'],
					['description', 1, 1.23, null, 1.23, 'ea'],
					['description', 1, 1.23, 'lb', 'non-numeric', 'ea'],
					['description', 1, 1.23, 'lb', null, 'ea'],
					['description', 1, 1.23, 'lb', 1.23, 'oz'],
					['description', 1, 1.23, 'lb', 1.23, null],
				]]);
			});

			$this->describe('with valid parameters', function () {
				$this->should('create a new resource and return a 201', function () {
					$values = [
						'description' => 'description',
						'quantity' => 12,
						'weight' => 1.23,
						'weight_units' => 'lb',
						'price' => 17.50,
						'price_units' => 'kg',
					];
					$response = $this->post(route('apiInventoryCreate'), $values);

					$response->assertStatus(201);

					$contents = json_decode($response->getContent(), true);

					foreach ($values as $key => $value) {
						$this->assertEquals($value, $contents['data'][$key]);
					}
				});
			});
		});
	}

	public function testShow()
	{	
		$this->specify($this->class.'::show()', function () {
			$this->describe('with an invalid uuid', function () {
				$this->should('return a 404 response', function () {
					$item = $this->createInventoryItem();
					do {
						$uuid = uuid();
					} while ($uuid == $item->id);

					$response = $this->get(route('apiInventoryShow', [$uuid]));

					$response->assertStatus(404);
				});
			});

			$this->describe('with a valid uuid', function () {
				$this->should('return a 200 response with the desired resource', function () {
					$item = $this->createInventoryItem();

					$response = $this->get(route('apiInventoryShow', [$item->id]));

					$response->assertStatus(200);

					$contents = json_decode($response->getContent(), true);

					$this->assertEquals($item->id, $contents['data']['id']);
				});
			});
		});
	}

	public function testUpdate()
	{
		$this->specify($this->class.'::update()', function () {
			$this->describe('with invalid parameters', function () {
				$this->should('throw an exception and return a 422', function ($description, $quantity, $weight, $weightUnits, $price, $priceUnits) {
					$item = $this->createInventoryItem();

					$response = $this->patch(route('apiInventoryUpdate', $item->id), [
						'description' => $description,
						'quantity' => $quantity,
						'weight' => $weight,
						'weight_units' => $weightUnits,
						'price' => $price,
						'price_units' => $priceUnits,
					]);

					$response->assertStatus(422);
				}, ['examples' => [
					[null, null, 1.23, 'lb', 1.23, 'ea'],
					['description', 'non-numeric', 1.23, 'lb', 1.23, 'ea'],
					['description', 1.23, 1.23, 'lb', 1.23, 'ea'],
					['description', 1, 'non-numeric', 'lb', 1.23, 'ea'],
					['description', 1, null, 'lb', 1.23, 'ea'],
					['description', 1, 1.23, 'oz', 1.23, 'ea'],
					['description', 1, 1.23, null, 1.23, 'ea'],
					['description', 1, 1.23, 'lb', 'non-numeric', 'ea'],
					['description', 1, 1.23, 'lb', null, 'ea'],
					['description', 1, 1.23, 'lb', 1.23, 'oz'],
					['description', 1, 1.23, 'lb', 1.23, null],
				]]);
			});

			$this->describe('with valid parameters', function () {
				$this->should('return a 202 response with the updated resource', function () {
					$originalValues = [
						'description' => 'description',
						'quantity' => 12,
						'weight' => 1.23,
						'weight_units' => 'lb',
						'price' => 17.50,
						'price_units' => 'kg',
					];
					$item = $this->createInventoryItem($originalValues);

					$newValues = [
						'description' => 'new description',
						'quantity' => 7,
						'weight' => 4.87,
						'weight_units' => 'kg',
						'price' => 5.89,
						'price_units' => 'ea',
					];

					$response = $this->patch(route('apiInventoryUpdate', $item->id), $newValues);

					$response->assertStatus(202);

					$content = json_decode($response->getContent(), true);

					foreach($newValues as $key => $value) {
						$this->assertEquals($value, $content['data'][$key]);
					}
				});
			});
		});
	}

	public function testDelete()
	{
		$this->specify($this->class.'::delete()', function () {
			$this->describe('when passed an invalid uuid', function () {
				$this->should('return a 404 response', function () {
					$item = $this->createInventoryItem();
					do {
						$uuid = uuid();
					} while ($uuid == $item->id);

					$response = $this->delete(route('apiInventoryDelete', [$uuid]));

					$response->assertStatus(404);
				});
			});

			$this->describe('when passed a valid uuid', function () {
				$this->should('delete the record and return a 204 response', function () {
					$item = $this->createInventoryItem();

					$response = $this->delete(route('apiInventoryDelete', [$item->id]));

					$response->assertStatus(204);

					$this->assertNull(Inventory::find($item->id));
				});
			});
		});
	}
}
