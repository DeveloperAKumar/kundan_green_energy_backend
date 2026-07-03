<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MainGallery;
use Illuminate\Http\Request;

class GalleryApiController extends Controller
{
     public function index()
    {
        $gallery = MainGallery::where('status', 1)
            ->latest()
            ->get();

        if ($gallery->isEmpty()) {

            return response()->json([
                'status' => false,
                'message' => 'Gallery images not found.',
                'data' => []
            ]);

        }

        $data = $gallery->map(function ($image) {

            return [

                'id' => $image->id,

                'image' => $image->image
                    ? asset($image->image)
                    : null,

            ];

        });

        return response()->json([
            'status' => true,
            'message' => 'Gallery images fetched successfully.',
            'data' => $data
        ]);
    }
}
