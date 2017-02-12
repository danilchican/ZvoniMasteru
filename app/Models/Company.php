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
     * An contacts is owned by a company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contacts()
    {
        return $this->hasOne(Contact::class);
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
     * Getting the company's slug.
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
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
     * @return mixed|string
     */
    public function getName()
    {
        if ($this->nameIsEmpty()) {
            return 'Без имени';
        }

        return $this->name;
    }

    /**
     * Get the description of the company.
     *
     * @return mixed|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the UNP number of the company.
     *
     * @return mixed|string
     */
    public function getUNPNumber()
    {
        return $this->unp_number;
    }

    /**
     * Get status of the company.
     *
     * @return mixed|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Getting categories for a company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'company_category', 'company_id', 'category_id');
    }

    /**
     * Accepted for publish to catalog.
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('status', '=', 'approved');
    }

    /**
     * Check if the company published in catalog.
     *
     * @return bool
     */
    public function isPublished()
    {
        if(!strcmp($this->getStatus(), 'approved')) {
            return true;
        }

        return false;
    }
}
