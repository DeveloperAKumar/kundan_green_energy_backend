<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsApiController extends Controller
{
     public function index()
    {
        $news = News::where('status', 1)
            ->latest()
            ->get();

        if ($news->isEmpty()) {

            return response()->json([
                'status' => false,
                'message' => 'No news found.',
                'data' => []
            ]);

        }

        $data = $news->map(function ($item) {

            return [

                'id' => $item->id,

                'title' => $item->title,

                'image' => $item->image
                    ? asset($item->image)
                    : null,

                'date' => $item->date,

                'url' => $item->url,

            ];

        });

        return response()->json([
            'status' => true,
            'message' => 'News fetched successfully.',
            'data' => $data
        ]);
    }

}
