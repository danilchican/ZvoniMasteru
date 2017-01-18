<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    const DEFAULT_THUMBNAIL = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjcwIiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE0MHgxNDA8L3RleHQ+PC9zdmc+';

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
     * @param null $parent_id |int
     */
    public function setParentCategory($parent_id = null)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * Set thumbnail url for a category.
     *
     * @param $path |string
     */
    public function setThumbnailPath($path)
    {
        $this->thumbnail_url = $path;
    }

    /**
     * Check if the category has thumbnail.
     *
     * @return bool
     */
    public function hasThumbnail()
    {
        return $this->getThumbnailPath() !== null;
    }

    /**
     * Get the thumbnail URL of the category.
     *
     * @return mixed|string
     */
    public function getThumbnailURL()
    {
        if ($this->hasThumbnail()) {
            return '/'.$this->getThumbnailPath();
        }

        return self::DEFAULT_THUMBNAIL;
    }

    /**
     * Get thumbnail path of the category.
     *
     * @return mixed|string
     */
    public function getThumbnailPath()
    {
        return $this->thumbnail_url;
    }

    /**
     * Get the name of the category.
     *
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the slug.
     *
     * @return mixed|string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the description.
     *
     * @return mixed|string
     */
    public function getDescription()
    {
        return $this->desc;
    }

    /**
     * Get parent category id.
     *
     * @return mixed|int
     */
    public function getParentCategoryID()
    {
        return $this->parent_id;
    }
}
