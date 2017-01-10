<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'policy_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get user's policy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Policy::class, 'policy_id');
    }

    /**
     * Check if user has a role.
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole($role = 'admin')
    {
        switch ($role) {
            case 'admin':
                return $this->isAdministrator();
            default:
                return false;
        }
    }

    /**
     * Check if user is administrator.
     *
     * @return bool
     */
    public function isAdministrator()
    {
        return $this->role->id == 1;
    }

    /**
     * User has one company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    /**
     * Check if the user has name.
     *
     * @return bool
     */
    public function nameIsEmpty()
    {
        if(!$this->name) {
            return true;
        }

        return false;
    }

    /**
     * Get the name of the company owner.
     *
     * @return mixed
     */
    public function getName()
    {
        if($this->nameIsEmpty()) {
            return 'No name';
        }

        return $this->name;
    }
}
