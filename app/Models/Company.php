<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'logo_url', 'unp_number', 'slug', 'status',
    ];

    /**
     * An company is owned by a user.
     *
     * @return array
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Getting the company's logo url.
     *
     * @return mixed
     */
    public function getLogoUrl()
    {
        return $this->logo_url;
    }

    /**
     * Check if the company has any logo.
     *
     * @return bool
     */
    public function hasLogo()
    {
        if (!$this->getLogoUrl()) {
            return false;
        }

        return true;
    }

    /**
     * Get the company logo.
     *
     * @return mixed
     */
    public function getLogo()
    {
        if ($this->hasLogo()) {
            return $this->getLogoUrl();
        }

        return '/images/no_avatar.png';
    }

    /**
     * Check if the user has name.
     *
     * @return bool
     */
    public function nameIsEmpty()
    {
        if (!$this->name) {
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
        if ($this->nameIsEmpty()) {
            return 'No name';
        }

        return $this->name;
    }
}
