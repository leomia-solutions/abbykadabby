<?php

namespace App\Services;

use App\Inventory;
use Illuminate\Database\Eloquent\Collection;

class InventoryService
{
	/**
	 * Performs a basic substring search
	 * 
	 * @var string $terms
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function search($terms): Collection
	{
		return Inventory::all();
	}
}