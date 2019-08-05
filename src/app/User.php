<?php

namespace App;

use App\Traits\Encryptable;
use App\Traits\UuidOnCreation;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $first_name_lower
 * @property string $last_name_lower
 * @property string $email
 * @property string $password
 *
 * dynamic properties
 * @property string $full_name
 */
class User extends Authenticatable
{
    use Notifiable, Encryptable, SoftDeletes, UuidOnCreation;

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

    protected $encryptable = [
        'password',
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

    public function setFirstNameAttribute($firstName)
    {
        $this->attributes['first_name_lower'] = strtolower($firstName) ?? '';
        $this->attributes['first_name'] = $firstName;
    }

    public function setLastNameAttribute($lastName)
    {
        $this->attributes['last_name_lower'] = strtolower($lastName) ?? '';
        $this->attributes['last_name'] = $lastName;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ($this->last_name ? ' ' . $this->last_name : '');
    }
}
