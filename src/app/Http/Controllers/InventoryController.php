<?php

namespace App\Http\Controllers;

use App\Inventory;
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
}
