<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'desc', 'thumbnail_url', 'parent_id', '_lft', '_rgt',
    ];

    /**
     * Set parent id for current category.
     *
     * @param null $parent_id
     */
    public function setParentCategory($parent_id = null)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * Set thumbnail url for a category.
     *
     * @param $path|string
     */
    public function setThumbnailPath($path)
    {
        $this->thumbnail_url = $path;
    }
}
