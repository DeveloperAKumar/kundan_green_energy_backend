<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogApiController extends Controller
{
     public function index()
    {
        $blogs = Blog::where('status', 1)
            ->latest()
            ->get();

        if ($blogs->isEmpty()) {

            return response()->json([
                'status' => false,
                'message' => 'No blogs found.',
                'data' => []
            ]);

        }

        $data = $blogs->map(function ($blog) {

            return [

                'id' => $blog->id,

                'title' => $blog->title,

                'slug' => $blog->slug,

                'thumbnail' => $blog->thumbnail
                    ? asset($blog->thumbnail)
                    : null,

                'published_by' => $blog->published_by,

                'created_at' => $blog->created_at->format('d M Y'),

            ];

        });

        return response()->json([

            'status' => true,

            'message' => 'Blogs fetched successfully.',

            'data' => $data

        ]);
    }

    /**
     * Blog Details
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 1)
            ->first();

        if (!$blog) {

            return response()->json([
                'status' => false,
                'message' => 'Blog not found.',
                'data' => null
            ]);

        }

        $data = [

            'id' => $blog->id,

            'title' => $blog->title,

            'slug' => $blog->slug,

            'thumbnail' => $blog->thumbnail
                ? asset($blog->thumbnail)
                : null,

            'content' => $blog->content,

            'published_by' => $blog->published_by,

            'meta_title' => $blog->meta_title,

            'meta_keyword' => $blog->meta_keyword,

            'meta_description' => $blog->meta_description,

            'created_at' => $blog->created_at->format('d M Y'),

        ];

        return response()->json([

            'status' => true,

            'message' => 'Blog details fetched successfully.',

            'data' => $data

        ]);
    }
}
