<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
     public function index()
    {
        $teams = Team::latest()->get();

        return view(
            'backend.team.index',
            compact('teams')
        );
    }

    public function create()
    {
        return view('backend.team.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'member_type' => 'required|in:team_member,board_member',

            'name' => 'required|max:255',

            'designation' => 'required|max:255',

            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',

        ]);

        $team = new Team();

        $team->member_type = $request->member_type;

        $team->name = $request->name;

        $team->designation = $request->designation;

        if($request->hasFile('photo')){

            $destination = public_path('uploads/team');

            if(!File::exists($destination)){

                File::makeDirectory($destination,0755,true);

            }

            $file = $request->file('photo');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $file->move($destination,$filename);

            $team->photo = 'uploads/team/'.$filename;

        }

        $team->status = true;

        $team->save();

        return redirect()
            ->route('backend.team')
            ->with('success','Team member added successfully.');

    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $team = Team::findOrFail($id);

        return view(
            'backend.team.edit',
            compact('team')
        );
    }

    public function update(Request $request,$id)
    {
        $id = Crypt::decrypt($id);

        $team = Team::findOrFail($id);

        $request->validate([

            'member_type' => 'required|in:team_member,board_member',

            'name' => 'required|max:255',

            'designation' => 'required|max:255',

            'status' => 'required|boolean',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

        ]);

        $team->member_type = $request->member_type;

        $team->name = $request->name;

        $team->designation = $request->designation;

        $team->status = $request->status;

        if($request->hasFile('photo')){

            if(
                $team->photo &&
                File::exists(public_path($team->photo))
            ){

                File::delete(public_path($team->photo));

            }

            $destination = public_path('uploads/team');

            if(!File::exists($destination)){

                File::makeDirectory($destination,0755,true);

            }

            $file = $request->file('photo');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $file->move($destination,$filename);

            $team->photo = 'uploads/team/'.$filename;

        }

        $team->save();

        return redirect()
            ->route('backend.team')
            ->with('success','Team member updated successfully.');

    }

    public function destroy(Request $request)
    {
        $team = Team::find($request->id);

        if(!$team){

            return response()->json([
                'status' => false,
                'message' => 'Record not found.'
            ]);

        }

        if(
            $team->photo &&
            File::exists(public_path($team->photo))
        ){

            File::delete(public_path($team->photo));

        }

        $team->delete();

        return response()->json([
            'status' => true
        ]);
    }
}
