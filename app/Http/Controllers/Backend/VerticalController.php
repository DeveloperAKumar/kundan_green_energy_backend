<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vertical;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class VerticalController extends Controller
{
    public function index()
    {
        $verticals = Vertical::latest()->get();

        return view(
            'backend.vertical.index',
            compact('verticals')
        );
    }

    public function create()
    {
        return view('backend.vertical.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'banner_heading' => 'required|max:255',
            'banner_sub_heading' => 'required|max:255',
            'banner_description' => 'required',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $vertical = new Vertical();

        $vertical->name = $request->name;

        $vertical->slug = Str::slug($request->name);

        $vertical->banner_heading = $request->banner_heading;

        $vertical->banner_sub_heading = $request->banner_sub_heading;

        $vertical->banner_description = $request->banner_description;

        if ($request->hasFile('banner_image')) {

            $file = $request->file('banner_image');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $destination = public_path('uploads/vertical');

            if (!File::exists($destination)) {
                File::makeDirectory($destination,0755,true);
            }

            $file->move($destination,$filename);

            $vertical->banner_image = 'uploads/vertical/'.$filename;

        }

        $vertical->status = true;

        $vertical->save();

        return redirect()
            ->route('backend.vertical')
            ->with('success','Vertical created successfully.');

    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $vertical = Vertical::findOrFail($id);

        return view(
            'backend.vertical.edit',
            compact('vertical')
        );
    }

    public function update(Request $request,$id)
    {
        $id = Crypt::decrypt($id);

        $vertical = Vertical::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'banner_heading' => 'required|max:255',
            'banner_sub_heading' => 'required|max:255',
            'banner_description' => 'required',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'required|boolean',
        ]);

        $vertical->name = $request->name;

        $vertical->slug = Str::slug($request->name);

        $vertical->banner_heading = $request->banner_heading;

        $vertical->banner_sub_heading = $request->banner_sub_heading;

        $vertical->banner_description = $request->banner_description;

        $vertical->status = $request->status;

        if($request->hasFile('banner_image')){

            if(
                $vertical->banner_image &&
                File::exists(public_path($vertical->banner_image))
            ){
                File::delete(public_path($vertical->banner_image));
            }

            $file = $request->file('banner_image');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $destination = public_path('uploads/vertical');

            if(!File::exists($destination)){
                File::makeDirectory($destination,0755,true);
            }

            $file->move($destination,$filename);

            $vertical->banner_image='uploads/vertical/'.$filename;

        }

        $vertical->save();

        return redirect()
            ->route('backend.vertical')
            ->with('success','Vertical updated successfully.');

    }

    public function destroy(Request $request)
    {
        $vertical = Vertical::find($request->id);

        if(!$vertical){

            return response()->json([
                'status'=>false,
                'message'=>'Vertical not found.'
            ]);

        }

        if(
            $vertical->banner_image &&
            File::exists(public_path($vertical->banner_image))
        ){
            File::delete(public_path($vertical->banner_image));
        }

        $vertical->delete();

        return response()->json([
            'status'=>true
        ]);
    }
}
