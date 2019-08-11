<?php

namespace App;

use App\Inventory;
use App\Traits\UuidOnCreation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $first_name_lower
 * @property string $last_name_lower
 * @property string $email
 * @property string $password
 * @property string $api_token
 *
 * dynamic properties
 * @property string $full_name
 */
class User extends Authenticable
{
    use Notifiable, SoftDeletes, UuidOnCreation;
    
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setFirstNameAttribute($firstName)
    {
        $this->attributes['first_name_lower'] = Str::lower($firstName);
        $this->attributes['first_name'] = $firstName;
    }

    public function setLastNameAttribute($lastName)
    {
        $this->attributes['last_name_lower'] = Str::lower($lastName);
        $this->attributes['last_name'] = $lastName;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ($this->last_name ? ' ' . $this->last_name : '');
    }

    public function inventoryItems()
    {
        return $this->hasMany(Inventory::class);
    }

    public function scopeAuthenticatedBy($query, $username, $password)
    {
        return $query->where('email', $username)->where('password', Hash::make($password));
    }
}
