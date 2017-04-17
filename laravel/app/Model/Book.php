<?php

namespace Wagg\Yondel\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'team_id',
        'recommender_id',
        'title',
        'asin',
    ];

    public function readers()
    {
        return $this->belongsToMany(User::class);
    }

    public function recommender()
    {
        return $this->hasOne(User::class, 'id', 'recommender_id');
    }

    public function comments()
    {
        return $this->hasMany(BookComment::class);
    }
}
