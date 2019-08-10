<?php

namespace App\Http\Controllers\API;

use App\Inventory;
use App\Http\Resources\InventoryCollection;
use App\Http\Requests\API\Inventory\CreateRequest;
use App\Http\Requests\API\Inventory\ListRequest;
use App\Http\Requests\API\Inventory\UpdateRequest;
use App\Services\InventoryService;

class InventoryController
{
	public function list(ListRequest $request, InventoryService $service)
	{
		$data = $request->validated();

		$searchTerms = array_get($data, 'description_contains', '');

		return new InventoryCollection($service->search($searchTerms)->paginate());
	}

	public function create(CreateRequest $request)
	{
        $data = $request->validated();

        $item = Inventory::create($request->validated());

        return response(new InventoryCollection($item), 201);
	}

	public function show(Inventory $inventory)
	{
		return view('inventory.show', $inventory);
	}

	public function update(UpdateRequest $request, Inventory $inventory)
	{
        $data = $request->validated();

        $item->description = $data['description'];
        $item->quantity = $data['quantity'];
        $item->weight = $data['weight'];
        $item->weight_units = $data['weight_units'];
        $item->price = $data['price'];
        $item->price_units = $data['price_units'];
        $item->save();

        return redirect(route('inventoryList'));

	}

	public function delete(Inventory $inventory)
	{
		$inventory->delete();

		return response('', 204);
	}
}
