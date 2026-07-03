<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        "company_name",
        "website",
        "logo_image",
        "favicon",
        "primary_phone",
        "primary_email",
        "address",
        "copyright_text",
        "google_map",
        "meta_title",
        "meta_keyword",
        "meta_description"
    ];
}
