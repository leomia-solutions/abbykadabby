<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Inventory\SearchRequest;
use App\Services\InventoryService;

class InventoryController
{
	public function list()
	{

	}

	public function search(SearchRequest $request, InventoryService $service)
	{
		$data = $request->validated();

		$results = $service->search($data['terms']);

		return ['data' => $results];
	}
}
