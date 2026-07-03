<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
       use HasFactory;

    protected $fillable=[

        'title',

        'thumbnail',

        'date',

        'description',

        'status'

    ];

    public function images()
    {
        return $this->hasMany(EventImage::class);
    }
}
