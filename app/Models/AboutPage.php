<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutPage extends Model
{
     use HasFactory;

    protected $fillable = [

        'who_we_are_small_heading',
        'who_we_are_heading',
        'who_we_are_description',
        'who_we_are_image',

        'vision_small_heading',
        'vision_heading',
        'vision_description',
        'vision_image',

        'mission_small_heading',
        'mission_heading',
        'mission_description',
        'mission_image',

        'status'

    ];
}
