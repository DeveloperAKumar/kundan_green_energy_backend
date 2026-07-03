<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [

        'title',

        'category',

        'capacity',

        'location',

        'established',

        'description',

        'status'

    ];

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }

}
