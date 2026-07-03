<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerticalSection extends Model
{
       use HasFactory;

    protected $fillable = [

        'vertical_id',

        'sub_heading',

        'heading',

        'description',

        'image',

        'image_position',

        'sort_order',

        'status'

    ];

    public function vertical()
    {
        return $this->belongsTo(Vertical::class);
    }
}
