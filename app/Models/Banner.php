<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        "name",
        "heading",
        "url",
        "image",
        "sort_order",
        "status",
    ];
}
