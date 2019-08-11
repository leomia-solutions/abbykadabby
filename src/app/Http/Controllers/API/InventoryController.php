<?php

namespace App\Http\Controllers\API;

use App\Inventory;
use App\Http\Resources\InventoryCollection;
use App\Http\Resources\InventoryResource;
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
        $item = Inventory::create($request->validated());

        return response(['data' => new InventoryResource($item)], 201);
    }

    public function show(Inventory $item)
    {
        return new InventoryResource($item);
    }

    public function update(UpdateRequest $request, Inventory $item)
    {
        $data = $request->validated();

        $item->description = $data['description'];
        $item->quantity = $data['quantity'];
        $item->weight = $data['weight'];
        $item->weight_units = $data['weight_units'];
        $item->price = $data['price'];
        $item->price_units = $data['price_units'];
        $item->save();

        return response(['data' => new InventoryResource($item)], 202);
    }

    public function delete(Inventory $item)
    {
        $item->delete();

        return response('', 204);
    }
}
