<?php

namespace App\Services;

use App\Inventory;
use Illuminate\Support\Collection;

class InventoryService
{
    /**
     * Performs a basic substring search
     *
     * @var string $terms
     *
     * @return \Illuminate\Support\Collection
     */
    public function search($terms): Collection
    {
        $terms = trim($terms);
        
        if (empty($terms)) {
            return collect(new Inventory());
        }

        $termsArray = explode(' ', $terms);

        $firstTerm = $termsArray[0];

        $builder = Inventory::where('description_lower', 'like', "%{$firstTerm}%");
        unset($termsArray[0]);

        foreach ($termsArray as $term) {
            $builder = $builder->orWhere('description_lower', 'like', "%{$term}%");
        }

        return $builder->get();
    }
}
