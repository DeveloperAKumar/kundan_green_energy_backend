<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventApiController extends Controller
{
     public function index()
    {
        $events = Event::where('status', 1)
            ->latest()
            ->get();

        if ($events->isEmpty()) {

            return response()->json([
                'status' => false,
                'message' => 'No events found.',
                'data' => []
            ]);

        }

        $data = $events->map(function ($event) {

            return [

                'id' => $event->id,

                'title' => $event->title,

                'slug' => $event->slug,

                'date' => $event->date,

                'thumbnail' => $event->thumbnail
                    ? asset($event->thumbnail)
                    : null,

            ];

        });

        return response()->json([
            'status' => true,
            'message' => 'Events fetched successfully.',
            'data' => $data
        ]);
    }

    /**
     * Event Details
     */
    public function show($slug)
    {
        $event = Event::with([
            'images' => function ($query) {
                $query->where('status', 1)
                      ->orderBy('album_name');
            }
        ])
        ->where('slug', $slug)
        ->where('status', 1)
        ->first();

        if (!$event) {

            return response()->json([
                'status' => false,
                'message' => 'Event not found.',
                'data' => null
            ]);

        }

        $albums = $event->images
            ->groupBy('album_name')
            ->map(function ($images, $albumName) {

                return [

                    'album_name' => $albumName,

                    'images' => $images->map(function ($image) {

                        return [

                            'id' => $image->id,

                            'image' => asset($image->image),

                        ];

                    })->values()

                ];

            })->values();

        $data = [

            'id' => $event->id,

            'title' => $event->title,

            'slug' => $event->slug,

            'date' => $event->date,

            'thumbnail' => $event->thumbnail
                ? asset($event->thumbnail)
                : null,

            'description' => $event->description,

            'meta_title' => $event->meta_title,

            'meta_keyword' => $event->meta_keyword,

            'meta_description' => $event->meta_description,

            'albums' => $albums,

        ];

        return response()->json([
            'status' => true,
            'message' => 'Event details fetched successfully.',
            'data' => $data
        ]);
    }
}
