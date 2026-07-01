<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        "title",
        "thumbnail",
        "content",
        "slug",
        "meta_title",
        "meta_keyword",
        "meta_description",
        "published_by",
        "status"
    ];
}
