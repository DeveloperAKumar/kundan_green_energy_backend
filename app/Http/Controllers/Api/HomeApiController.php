<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\ContentGallery;
use App\Models\HomeVideo;
use App\Models\ProjectsAcrossIndia;
use App\Models\ValuedPartnership;
use Illuminate\Http\Request;

class HomeApiController extends Controller
{
    public function banners()
    {
        $banners = Banner::where('status', 1)
            ->orderBy('sort_order', 'ASC')
            ->get();

        if ($banners->isEmpty()) {

            return response()->json([
                'status' => false,
                'message' => 'No banner found.',
                'data' => []
            ]);
        }

        $data = $banners->map(function ($banner) {

            return [

                'id' => $banner->id,

                'name' => $banner->name,

                'heading' => $banner->heading,

                'sub_heading' => $banner->sub_heading,

                'url' => $banner->url,

                'type' => $banner->type,

                'video' => $banner->video,

                'sort_order' => $banner->sort_order,

                'image' => $banner->image
                    ? asset($banner->image)
                    : null,

            ];
        });

        return response()->json([

            'status' => true,

            'message' => 'Banner list fetched successfully.',

            'data' => $data

        ]);
    }

    public function valuedPartnerships()
    {
        $partnerships = ValuedPartnership::where('status', 1)
            ->latest()
            ->get();

        if ($partnerships->isEmpty()) {

            return response()->json([
                'status' => false,
                'message' => 'No valued partnerships found.',
                'data' => []
            ]);
        }

        $data = $partnerships->map(function ($partnership) {

            return [

                'id' => $partnership->id,

                'image' => $partnership->image
                    ? asset($partnership->image)
                    : null,

            ];
        });

        return response()->json([

            'status' => true,

            'message' => 'Valued partnerships fetched successfully.',

            'data' => $data

        ]);
    }


    public function projectsAcrossIndia()
    {
        $projects = ProjectsAcrossIndia::where('status', 1)
            ->orderBy('id', 'ASC')
            ->get();

        if ($projects->isEmpty()) {

            return response()->json([
                'status' => false,
                'message' => 'No projects found.',
                'data' => []
            ]);
        }

        $data = $projects->map(function ($project) {

            return [

                'id' => $project->id,

                'name' => $project->name,

                'allotment' => $project->allotment,

                'detail' => $project->detail,

                'type' => $project->type,

            ];
        });

        return response()->json([

            'status' => true,

            'message' => 'Projects fetched successfully.',

            'data' => $data

        ]);
    }

public function homeVideo(){
    $video = HomeVideo::where('status', 1)->first();
    if (!$video) {
        return response()->json([
            'status' => false,
            'message' => 'Home video not found.',
            'data' => null
        ]);
    }
    $data = [
        'id' => $video->id,
        'video' => $video->video
            ? asset($video->video)
            : null,

    ];
    return response()->json([
        'status' => true,
        'message' => 'Home video fetched successfully.',
        'data' => $data

    ]);
}



public function contentGallery(){
    $galleries = ContentGallery::where('status', 1)
        ->latest()
        ->get();

    if ($galleries->isEmpty()) {

        return response()->json([
            'status' => false,
            'message' => 'Content gallery not found.',
            'data' => []
        ]);

    }

    $data = $galleries->map(function ($gallery) {

        return [

            'id' => $gallery->id,

            'heading' => $gallery->heading,

            'image' => $gallery->image
                ? asset($gallery->image)
                : null,

        ];

    });

    return response()->json([

        'status' => true,

        'message' => 'Content gallery fetched successfully.',

        'data' => $data

    ]);
}













}
