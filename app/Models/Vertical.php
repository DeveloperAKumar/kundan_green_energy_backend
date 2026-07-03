<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vertical extends Model
{
      use HasFactory;

    protected $fillable = [

        'name',

        'slug',

        'banner_image',

        'banner_sub_heading',

        'banner_heading',

        'banner_description',

        'status'

    ];

    public function sections()
    {
        return $this->hasMany(VerticalSection::class);
    }

    public function advantages()
    {
        return $this->hasMany(VerticalAdvantage::class);
    }

  

    
}
