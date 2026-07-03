<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OtherPage;
use Illuminate\Http\Request;

class OtherPageApiController extends Controller
{

public function index()
{
    $pages = OtherPage::where('status', 1)
        ->latest()
        ->get();

    if ($pages->isEmpty()) {

        return response()->json([
            'status' => false,
            'message' => 'No pages found.',
            'data' => []
        ]);

    }

    $data = $pages->map(function ($page) {

        return [

            'id' => $page->id,

            'name' => $page->name,

            'slug' => $page->slug,

        ];

    });

    return response()->json([

        'status' => true,

        'message' => 'Pages fetched successfully.',

        'data' => $data

    ]);
}

       public function show($slug)
    {
        $page = OtherPage::where('slug', $slug)
            ->where('status', 1)
            ->first();

        if (!$page) {

            return response()->json([
                'status' => false,
                'message' => 'Page not found.',
                'data' => null
            ]);

        }

        $data = [

            'id' => $page->id,

            'name' => $page->name,

            'slug' => $page->slug,

            'content' => $page->content,

            'published_by' => $page->published_by,

            'meta_title' => $page->meta_title,

            'meta_keyword' => $page->meta_keyword,

            'meta_description' => $page->meta_description,

            'created_at' => $page->created_at->format('d M Y'),

        ];

        return response()->json([

            'status' => true,

            'message' => 'Page fetched successfully.',

            'data' => $data

        ]);
    }
}
