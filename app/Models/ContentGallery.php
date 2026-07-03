<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentGallery extends Model
{
      protected $fillable = [
        'heading',
        'image',
        'status'
    ];
}
