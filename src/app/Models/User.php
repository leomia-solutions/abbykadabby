<?php

namespace App\Models;

use Bvipul\EncryptsAttributes\Traits\EncryptsAttributes;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

/**
 * @property int            $serial_no
 * @property string         $id
 * @property string         $first_name
 * @property string         $last_name
 * @property string         $email
 * @property string         $session_token
 * @property \Carbon\Carbon $session_expires
 * @property string         $password
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, EncryptsAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password',
    ];

    /**
     * The encrypted properties
     *
     * @var array
     */
    protected $encrypts = [
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @param string $password
     */
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = app('hash')->make($password);
    }
}
