<?php

namespace App\Services;

use App\Inventory;
use Illuminate\Database\Eloquent\Builder;

class InventoryService
{
    /**
     * Performs a basic substring search
     *
     * @var string $terms
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($terms): Builder
    {
        $builder = Inventory::query();

        $terms = trim($terms);
        $termsArray = explode(' ', $terms);

        foreach ($termsArray as $term) {
            $builder = $builder->orWhere('description_lower', 'like', "%{$term}%");
        }

        return $builder;
    }
}
