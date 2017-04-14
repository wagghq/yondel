<?php

namespace Wagg\Yondel\Model;

use Illuminate\Database\Eloquent\Model;

class BookComment extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'body',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
