<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProjectsAcrossIndia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProjectsAcrossIndiaController extends Controller
{
    public function index(){
        $projects = ProjectsAcrossIndia::latest()->get();
        return view('backend.projects_across_india.index', compact('projects'));
    }

    public function create(){
        return view('backend.projects_across_india.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'allotment' => 'required|max:255',
            'detail' => 'required',
            'type' => 'required'
        ]);

        $project = new ProjectsAcrossIndia();

        $project->name = $request->name;
        $project->allotment = $request->allotment;
        $project->detail = $request->detail;
        $project->type = $request->type;
        $project->save();

        return redirect()->route('backend.projects_across_india')->with('success', 'Project created successfully.');
    }

    public function edit($id){
        $id = Crypt::decrypt($id);
        $project = ProjectsAcrossIndia::findOrFail($id);
        return view('backend.projects_across_india.edit', compact('project'));
    }

    public function update(Request $request, $id){
        $id = Crypt::decrypt($id);
        $project = ProjectsAcrossIndia::findOrFail($id);
        $request->validate([
            'name' => 'required|max:255',
            'allotment' => 'required|max:255',
            'detail' => 'required',
            'type' => 'required',
            'status' => 'required|boolean'
        ]);

        $project->name = $request->name;
        $project->allotment = $request->allotment;
        $project->detail = $request->detail;
        $project->type = $request->type;
        $project->status = $request->status;
        $project->save();

        return redirect()->route('backend.projects_across_india')->with('success', 'Project updated successfully.');
    }

    public function destroy(Request $request){
        $project = ProjectsAcrossIndia::find($request->id);
        if (!$project) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found.'
            ]);
        }
        $project->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
