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
use Log;

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

    const ROLE_ADMIN = 'admin';
    
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
        'roles' => 'array',
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
        return $query->where('email', $username)->where('password', $password);// Hash::make($password));
    }

    /**
     * @param string $role
     *
     * @return $this
     */
    protected function addRole($role): self
    {
        $roles = $this->roles;
        $roles[] = $role;
        $roles = array_unique($roles);

        $this->roles = $roles;

        return $this;
    }

    /**
     * @param string $role
     *
     * @return $this
     */
    protected function revokeRole($role): self
    {
        $roles = $this->roles;
        $roles = array_diff($roles, [$role]);

        $this->roles = $roles;

        return $this;
    }

    /**
     * @return $this
     */
    public function makeAdmin(): self
    {
        return $this->addRole(self::ROLE_ADMIN);
    }

    public function revokeAdmin(): self
    {
        return $this->revokeRole(self::ROLE_ADMIN);
    }

    public function isAdmin(): bool
    {
        return $this->roles && in_array(self::ROLE_ADMIN, $this->roles);
    }
}
