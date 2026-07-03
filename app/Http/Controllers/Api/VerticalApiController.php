<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vertical;
use Illuminate\Http\Request;

class VerticalApiController extends Controller
{
    public function index()
{
    $verticals = Vertical::where('status', 1)
        ->orderBy('name')
        ->get();

    if ($verticals->isEmpty()) {
        return response()->json([
            'status' => false,
            'message' => 'No verticals found.',
            'data' => []
        ]);
    }

    $data = $verticals->map(function ($vertical) {

        return [

            'id' => $vertical->id,

            'name' => $vertical->name,

            'slug' => $vertical->slug,

            'banner_image' => $vertical->banner_image
                ? asset($vertical->banner_image)
                : null,

            'banner_sub_heading' => $vertical->banner_sub_heading,

            'banner_heading' => $vertical->banner_heading,

            'banner_description' => $vertical->banner_description,

        ];

    });

    return response()->json([
        'status' => true,
        'message' => 'Vertical list fetched successfully.',
        'data' => $data
    ]);
}

public function show($slug)
{
    $vertical = Vertical::with([

        'sections' => function ($query) {
            $query->where('status', 1)
                  ->orderBy('sort_order');
        },

        'advantages' => function ($query) {
            $query->where('status', 1)
                  ->orderBy('sort_order');
        },

        

    ])
    ->where('slug', $slug)
    ->where('status', 1)
    ->first();

    if (!$vertical) {
        return response()->json([
            'status' => false,
            'message' => 'Vertical not found.',
            'data' => null
        ]);
    }

    return response()->json([
        'status' => true,
        'message' => 'Vertical details fetched successfully.',
        'data' => $vertical
    ]);
}
}
