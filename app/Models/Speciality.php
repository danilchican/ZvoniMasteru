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
     * Get title of the speciality.
     *
     * @return mixed|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get slug of the speciality.
     *
     * @return mixed|string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get description of the speciality.
     *
     * @return mixed|string
     */
    public function getDescription()
    {
        return $this->desc;
    }

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
