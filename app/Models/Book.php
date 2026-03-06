<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'isbn',
        'cover_image',
        'description',
        'category_id',
        'author_id',
        'user_id',
        'published_at',
        'status',
        'active',
    ];
}
