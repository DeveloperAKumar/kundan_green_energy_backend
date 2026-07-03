<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingApiController extends Controller
{
     public function index()
    {
        $setting = SiteSetting::first();

        if (!$setting) {

            return response()->json([
                'status' => false,
                'message' => 'Site settings not found.',
                'data' => null
            ]);

        }

        $data = [

            'company_name' => $setting->company_name,

            'website' => $setting->webiste,

            'logo' => $setting->logo_image
                ? asset($setting->logo_image)
                : null,

            'favicon' => $setting->favicon
                ? asset($setting->favicon)
                : null,

            'primary_phone' => $setting->primary_phone,

            'primary_email' => $setting->primary_email,

            'address' => $setting->address,

            'copyright_text' => $setting->copyright_text,

            'google_map' => $setting->google_map,

            'meta_title' => $setting->meta_title,

            'meta_keyword' => $setting->meta_keyword,

            'meta_description' => $setting->meta_description,

        ];

        return response()->json([

            'status' => true,

            'message' => 'Site settings fetched successfully.',

            'data' => $data

        ]);
    }
}
