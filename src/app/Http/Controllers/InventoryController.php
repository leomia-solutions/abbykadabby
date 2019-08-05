<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Http\Request\Inventory\CreateRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function list()
    {
        $inventory = Inventory::all();

        return view('inventory/list', ['records' => $inventory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        dd($user);

        return view('inventory/create');
    }

    public function store(CreateRequest $request)
    {
        $user = auth()->user();
        $this->validate($request);

        Inventory::create($request->validated());

        return response('Created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
