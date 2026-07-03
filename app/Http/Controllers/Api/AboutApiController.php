<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\ChairmanMessage;
use App\Models\Team;
use Illuminate\Http\Request;

class AboutApiController extends Controller
{
      public function index()
    {
        $about = AboutPage::where('status', 1)->first();

        if (!$about) {

            return response()->json([
                'status' => false,
                'message' => 'About page not found.',
                'data' => null
            ]);

        }

        $data = [

            'who_we_are' => [

                'small_heading' => $about->who_we_are_small_heading,

                'heading' => $about->who_we_are_heading,

                'description' => $about->who_we_are_description,

                'image' => $about->who_we_are_image
                    ? asset($about->who_we_are_image)
                    : null,

            ],

            'vision' => [

                'small_heading' => $about->vision_small_heading,

                'heading' => $about->vision_heading,

                'description' => $about->vision_description,

                'image' => $about->vision_image
                    ? asset($about->vision_image)
                    : null,

            ],

            'mission' => [

                'small_heading' => $about->mission_small_heading,

                'heading' => $about->mission_heading,

                'description' => $about->mission_description,

                'image' => $about->mission_image
                    ? asset($about->mission_image)
                    : null,

            ]

        ];

        return response()->json([
            'status' => true,
            'message' => 'About page fetched successfully.',
            'data' => $data
        ]);
    }




    public function chairmanMessage()
{
    $message = ChairmanMessage::where('status', 1)->first();

    if (!$message) {

        return response()->json([
            'status' => false,
            'message' => 'Chairman message not found.',
            'data' => null
        ]);

    }

    $data = [

        'chairman' => [

            'name' => $message->chairman_name,

            'about' => $message->about_chairman,

            'image' => $message->chairman_image
                ? asset($message->chairman_image)
                : null,

        ],

        'managing_director' => [

            'name' => $message->md_name,

            'message' => $message->md_message,

            'image' => $message->md_image
                ? asset($message->md_image)
                : null,

        ]

    ];

    return response()->json([

        'status' => true,

        'message' => 'Chairman and Managing Director details fetched successfully.',

        'data' => $data

    ]);
}

public function team()
{
    $members = Team::where('status', 1)
        ->orderBy('id')
        ->get();

    if ($members->isEmpty()) {

        return response()->json([
            'status' => false,
            'message' => 'Team members not found.',
            'data' => []
        ]);

    }

    $data = [

        'team_members' => $members
            ->where('member_type', 'team_member')
            ->values()
            ->map(function ($member) {

                return [

                    'id' => $member->id,

                    'name' => $member->name,

                    'designation' => $member->designation,

                    'photo' => $member->photo
                        ? asset($member->photo)
                        : null,

                ];

            }),

        'board_members' => $members
            ->where('member_type', 'board_member')
            ->values()
            ->map(function ($member) {

                return [

                    'id' => $member->id,

                    'name' => $member->name,

                    'designation' => $member->designation,

                    'photo' => $member->photo
                        ? asset($member->photo)
                        : null,

                ];

            }),

    ];

    return response()->json([

        'status' => true,

        'message' => 'Team members fetched successfully.',

        'data' => $data

    ]);
}





}
