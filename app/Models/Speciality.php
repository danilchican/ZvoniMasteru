<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'specialities';

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
        'title', 'slug', 'desc',
    ];

    /**
     * Search specialities by keywords.
     *
     * @param $query
     * @param $keywords
     *
     * @return mixed
     */
    public function scopeSearchByKeywords($query, $keywords)
    {
        $query->where(function ($query) use ($keywords) {
            $query->where('title', 'LIKE', "%$keywords%")
                ->orWhere('slug', 'LIKE', "%$keywords%")
                ->orWhere('desc', 'LIKE', "%$keywords%");
        });

        return $query;
    }
}
