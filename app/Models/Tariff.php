<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    /**
     * @var string
     */
    protected $table = 'tariffs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'whom', 'additional_service', 'top', 'published',
    ];

    /**
     * Check if the tariff has been published.
     *
     * @return mixed
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * Get the top number of the tariff.
     *
     * @return mixed
     */
    public function getTopNumber()
    {
        return $this->top;
    }

    /**
     * Get the additional service for tariff.
     *
     * @return mixed
     */
    public function getAdditionalService()
    {
        return $this->additional_service;
    }

    /**
     * Get the whom variable.
     *
     * @return mixed
     */
    public function getWhom()
    {
        return $this->whom;
    }

    /**
     * Get the title of the Tariff.
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get all published tariffs.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published', '=', true);
    }

    /**
     * Set the relation between services and tariff.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_tariff', 'tariff_id', 'service_id');
    }

    /**
     * Get the prices of the current tariff.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices()
    {
        return $this->belongsToMany(Price::class, 'price_tariff', 'tariff_id', 'price_id');
    }
}
