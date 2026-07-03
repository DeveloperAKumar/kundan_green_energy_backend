<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Project;
use App\Models\ProjectImage;

class ProjectController extends Controller
{
      public function index()
    {
        $projects = Project::with('images')
            ->latest()
            ->get();

        return view(
            'backend.project.index',
            compact('projects')
        );
    }

    public function create()
    {
        return view('backend.project.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'capacity' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'established' => 'required|string|max:255',
            'description' => 'required',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        DB::beginTransaction();

        try {

            $project = Project::create([
                'title' => $request->title,
                'category' => $request->category,
                'capacity' => $request->capacity,
                'location' => $request->location,
                'established' => $request->established,
                'description' => $request->description,
                'status' => true,
            ]);

            $destination = public_path('uploads/project');

            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            foreach ($request->file('images') as $image) {

                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                $image->move($destination, $filename);

                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => 'uploads/project/' . $filename,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('backend.project')
                ->with('success', 'Project created successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);
        }
    }


    public function edit($id)
{
    $id = Crypt::decrypt($id);

    $project = Project::with('images')->findOrFail($id);

    return view(
        'backend.project.edit',
        compact('project')
    );
}

public function update(Request $request, $id)
{
    $id = Crypt::decrypt($id);

    $project = Project::with('images')->findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'capacity' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'established' => 'required|string|max:255',
        'description' => 'required',
        'status' => 'required|boolean',
        'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
    ]);

    DB::beginTransaction();

    try {

        $project->update([
            'title' => $request->title,
            'category' => $request->category,
            'capacity' => $request->capacity,
            'location' => $request->location,
            'established' => $request->established,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        if ($request->hasFile('images')) {

            $destination = public_path('uploads/project');

            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            foreach ($request->file('images') as $image) {

                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                $image->move($destination, $filename);

                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => 'uploads/project/' . $filename,
                ]);
            }

        }

        DB::commit();

        return redirect()
            ->route('backend.project')
            ->with('success', 'Project updated successfully.');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()
            ->withInput()
            ->withErrors([
                'error' => $e->getMessage()
            ]);
    }
}

public function destroyImage(Request $request)
{
    $image = ProjectImage::find($request->id);

    if (!$image) {

        return response()->json([
            'status' => false,
            'message' => 'Image not found.'
        ]);

    }

    try {

        if (
            $image->image &&
            File::exists(public_path($image->image))
        ) {
            File::delete(public_path($image->image));
        }

        $image->delete();

        return response()->json([
            'status' => true
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);

    }
}

public function destroy(Request $request)
{
    $project = Project::with('images')->find($request->id);

    if (!$project) {

        return response()->json([
            'status' => false,
            'message' => 'Project not found.'
        ]);

    }

    DB::beginTransaction();

    try {

        foreach ($project->images as $image) {

            if (
                $image->image &&
                File::exists(public_path($image->image))
            ) {
                File::delete(public_path($image->image));
            }

            $image->delete();

        }

        $project->delete();

        DB::commit();

        return response()->json([
            'status' => true
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);

    }
}

}
