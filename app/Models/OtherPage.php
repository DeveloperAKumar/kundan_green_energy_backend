<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherPage extends Model
{
    protected $fillable = [
        "name",
        "content",
        "slug",
        "meta_title",
        "meta_keyword",
        "meta_description",
        "published_by",
        "status",
    ];
}
