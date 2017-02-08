<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'socials';

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
        'vk_url', 'ok_url', 'fb_url'
    ];

    /**
     * Get VK url.
     *
     * @return mixed|string
     */
    public function getVkontakteURL()
    {
        return $this->vk_url;
    }

    /**
     * Get FB url.
     *
     * @return mixed|string
     */
    public function getFacebookURL()
    {
        return $this->fb_url;
    }

    /**
     * Get OK url.
     *
     * @return mixed|string
     */
    public function getOdnoklassnikiURL()
    {
        return $this->ok_url;
    }

    /**
     * An socials groups is owned by a contact of company.
     *
     * @return array
     */
    public function contacts()
    {
        return $this->belongsTo(Contact::class);
    }
}
