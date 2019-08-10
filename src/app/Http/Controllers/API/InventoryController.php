<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\InventoryCollection;
use App\Http\Requests\API\Inventory\SearchRequest;
use App\Services\InventoryService;

class InventoryController
{
	public function list()
	{
		return new InventoryCollection(Inventory::paginate());
	}

	public function search(SearchRequest $request, InventoryService $service)
	{
		$data = $request->validated();

		$results = $service->search($data['terms']);

		return new InventoryCollection($results->paginate());
	}
}
