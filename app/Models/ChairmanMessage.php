<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChairmanMessage extends Model
{
      use HasFactory;

  protected $fillable = [

    'chairman_name',
    'about_chairman',
    'chairman_image',

    'md_name',
    'md_message',
    'md_image',

    'status'

];
}
