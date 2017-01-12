<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tariff_prices';

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
    protected $fillable = ['tariff_id', 'price', 'range'];

    /**
     * Get the range of the price.
     *
     * @return mixed
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * Get the price.
     *
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price of the Price obj.
     *
     * @param $price
     *
     * @return mixed
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Set range of the Range obj.
     *
     * @param $range
     *
     * @return mixed
     */
    public function setRange($range)
    {
        $this->range = $range;
    }

    /**
     * Set the relation between prices and tariff.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tariffs()
    {
        return $this->belongsToMany(Tariff::class);
    }
}
