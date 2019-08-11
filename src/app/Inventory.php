<?php

namespace App;

use App\User;
use App\Traits\UuidOnCreation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property string $user_id
 * @property string $description
 * @property string $description_lower
 * @property float  $quantity
 * @property float  $weight
 * @property string $weight_units
 * @property float  $price
 * @property string $price_units
 *
 * @property \App\User $user
 */
class Inventory extends Model
{
    use SoftDeletes, UuidOnCreation;

    public $incrementing = false;

    protected $table = 'inventory';

    protected $fillable = [
        'user_id',
        'description',
        'quantity',
        'weight',
        'weight_units',
        'price',
        'price_units',
    ];

    /**
     * Sets the description_lower field, which is indexed
     */
    public function setDescriptionAttribute($description)
    {
        $this->attributes['description_lower'] = Str::lower($description);
        $this->attributes['description'] = $description;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
