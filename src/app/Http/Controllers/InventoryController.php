<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Http\Requests\Inventory\CreateRequest;
use App\Http\Requests\Inventory\EditRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function list()
    {
        $inventory = Inventory::all();

        return view('inventory.list', ['records' => $inventory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store the inventory item so long as the request is valid
     *
     * @param \App\Http\Requests\Inventory\CreateRequest $request
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        $item = Inventory::create($request->validated());

        return redirect(route('inventoryList'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('something');
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory $item
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $item)
    {
        return view('inventory.edit', ['record' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\Inventory\EditRequest  $request
     * @param  \App\Inventory $item
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Inventory $item)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $item
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Inventory $item)
    {
        $item->delete();

        return redirect(route('inventoryList'));
    }
}
