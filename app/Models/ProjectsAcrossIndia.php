<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectsAcrossIndia extends Model
{
    protected $fillable = [
        "name",
        "allotment",
        "detail",
        "type",
        "status"
    ];
}
