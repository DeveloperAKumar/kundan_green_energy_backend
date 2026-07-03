<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectApiController extends Controller
{
      /**
     * Project Listing
     */
    public function index()
    {
        $projects = Project::with('images')
            ->where('status', 1)
            ->latest()
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

                'title' => $project->title,

                'slug' => $project->slug,

                'category' => $project->category,

                'capacity' => $project->capacity,

                'location' => $project->location,

                'established' => $project->established,

                'thumbnail' => optional($project->images->first())->image
                    ? asset($project->images->first()->image)
                    : null,

            ];

        });

        return response()->json([
            'status' => true,
            'message' => 'Projects fetched successfully.',
            'data' => $data
        ]);
    }

    /**
     * Project Details
     */
    public function show($slug)
    {
        $project = Project::with('images')
            ->where('slug', $slug)
            ->where('status', 1)
            ->first();

        if (!$project) {

            return response()->json([
                'status' => false,
                'message' => 'Project not found.',
                'data' => null
            ]);

        }

        $data = [

            'id' => $project->id,

            'title' => $project->title,

            'slug' => $project->slug,

            'category' => $project->category,

            'capacity' => $project->capacity,

            'location' => $project->location,

            'established' => $project->established,

            'description' => $project->description,

            'meta_title' => $project->meta_title,

            'meta_keyword' => $project->meta_keyword,

            'meta_description' => $project->meta_description,

            'images' => $project->images->map(function ($image) {

                return [

                    'id' => $image->id,

                    'image' => asset($image->image),

                ];

            })->values()

        ];

        return response()->json([
            'status' => true,
            'message' => 'Project details fetched successfully.',
            'data' => $data
        ]);
    }
}
