<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerticalAdvantage extends Model
{
     use HasFactory;

    protected $fillable = [
        'vertical_id',
        'title',
        'description',
        'sort_order',
        'status'
    ];

    public function vertical()
    {
        return $this->belongsTo(Vertical::class);
    }
}
