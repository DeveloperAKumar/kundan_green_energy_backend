<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaApiController extends Controller
{
    public function index()
    {
        $socialMedia = SocialMedia::where('status', 1)
            ->orderBy('id')
            ->get();

        if ($socialMedia->isEmpty()) {

            return response()->json([
                'status' => false,
                'message' => 'No social media found.',
                'data' => []
            ]);

        }

        $data = $socialMedia->map(function ($item) {

            return [

                'id' => $item->id,

                'name' => $item->name,

                'icon' => $item->icon,

                'url' => $item->url,

            ];

        });

        return response()->json([
            'status' => true,
            'message' => 'Social media fetched successfully.',
            'data' => $data
        ]);
    }
}
