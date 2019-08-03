<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $user_id
 * @property string $description
 * @property float  $quantity
 * @property string $units
 * @property float  $price_per_unit
 *
 * @property \App\User $user
 */
class Inventory extends Model
{
	use SoftDeletes;
	
    protected $table = 'centers';
}
