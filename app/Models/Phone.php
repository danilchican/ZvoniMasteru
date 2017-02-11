<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'phones';

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
    protected $fillable = ['number'];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id', 'number'];

    /**
     * An contacts is owned by a company.
     *
     * @return array
     */
    public function contacts()
    {
        return $this->belongsToMany(Contact::class);
    }

    /**
     * Filled number.
     *
     * @param $query
     * @return mixed
     */
    public function scopeFilled($query)
    {
        return $query->where('number', '!=', '');
    }
}
