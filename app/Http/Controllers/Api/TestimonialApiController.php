<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialApiController extends Controller
{
     public function index()
    {
        $testimonials = Testimonial::where('status', 1)
            ->latest()
            ->get();

        if ($testimonials->isEmpty()) {

            return response()->json([
                'status' => false,
                'message' => 'No testimonials found.',
                'data' => []
            ]);

        }

        $data = $testimonials->map(function ($testimonial) {

            return [

                'id' => $testimonial->id,

                'name' => $testimonial->name,

                'designation' => $testimonial->designation,

                'photo' => $testimonial->photo
                    ? asset($testimonial->photo)
                    : null,

                'review' => $testimonial->review,

                'rating' => (int) $testimonial->rating,

            ];

        });

        return response()->json([

            'status' => true,

            'message' => 'Testimonials fetched successfully.',

            'data' => $data

        ]);
    }
}
