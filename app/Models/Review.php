<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author', 'email', 'advantages', 'disadvantages', 'phone'
    ];

    /**
     * An contacts is owned by a company.
     *
     * @return array
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get author email of the review.
     *
     * @return mixed|string
     */
    public function getAuthorEmail()
    {
        return $this->email;
    }

    /**
     * Get author name of the review.
     *
     * @return mixed|string
     */
    public function getAuthorName()
    {
        return $this->author;
    }

    /**
     * Get author advantages of the review.
     *
     * @return mixed|string
     */
    public function getAdvantages()
    {
        return $this->advantages;
    }

    /**
     * Get author disadvantages of the review.
     *
     * @return mixed|string
     */
    public function getDisadvantages()
    {
        return $this->disadvantages;
    }
}
