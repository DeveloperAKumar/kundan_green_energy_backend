<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;    
use App\Models\Vertical;
use App\Models\VerticalSection;

class VerticalSectionController extends Controller
{
     public function index()
    {
        $sections = VerticalSection::with('vertical')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view(
            'backend.vertical_section.index',
            compact('sections')
        );
    }

    public function create()
    {
        $verticals = Vertical::where('status',1)
            ->orderBy('name')
            ->get();

        return view(
            'backend.vertical_section.create',
            compact('verticals')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'vertical_id' => 'required|exists:verticals,id',
            'sub_heading' => 'required|max:255',
            'heading' => 'required|max:255',
            'description' => 'required',
            'image_position' => 'required|in:left,right',
            'sort_order' => 'required|integer',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $section = new VerticalSection();

        $section->vertical_id = $request->vertical_id;
        $section->sub_heading = $request->sub_heading;
        $section->heading = $request->heading;
        $section->description = $request->description;
        $section->image_position = $request->image_position;
        $section->sort_order = $request->sort_order;
        $section->status = true;

        if($request->hasFile('image')){

            $destination = public_path('uploads/vertical-section');

            if(!File::exists($destination)){
                File::makeDirectory($destination,0755,true);
            }

            $file = $request->file('image');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $file->move($destination,$filename);

            $section->image = 'uploads/vertical-section/'.$filename;

        }

        $section->save();

        return redirect()
            ->route('backend.vertical_section')
            ->with('success','Section created successfully.');

    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $section = VerticalSection::findOrFail($id);

        $verticals = Vertical::where('status',1)
            ->orderBy('name')
            ->get();

        return view(
            'backend.vertical_section.edit',
            compact('section','verticals')
        );
    }

    public function update(Request $request,$id)
    {
        $id = Crypt::decrypt($id);

        $section = VerticalSection::findOrFail($id);

        $request->validate([
            'vertical_id' => 'required|exists:verticals,id',
            'sub_heading' => 'required|max:255',
            'heading' => 'required|max:255',
            'description' => 'required',
            'image_position' => 'required|in:left,right',
            'sort_order' => 'required|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $section->vertical_id = $request->vertical_id;
        $section->sub_heading = $request->sub_heading;
        $section->heading = $request->heading;
        $section->description = $request->description;
        $section->image_position = $request->image_position;
        $section->sort_order = $request->sort_order;
        $section->status = $request->status;

        if($request->hasFile('image')){

            if(
                $section->image &&
                File::exists(public_path($section->image))
            ){
                File::delete(public_path($section->image));
            }

            $destination = public_path('uploads/vertical-section');

            if(!File::exists($destination)){
                File::makeDirectory($destination,0755,true);
            }

            $file = $request->file('image');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $file->move($destination,$filename);

            $section->image = 'uploads/vertical-section/'.$filename;

        }

        $section->save();

        return redirect()
            ->route('backend.vertical_section')
            ->with('success','Section updated successfully.');

    }

    public function destroy(Request $request)
    {
        $section = VerticalSection::find($request->id);

        if(!$section){

            return response()->json([
                'status' => false,
                'message' => 'Section not found.'
            ]);

        }

        if(
            $section->image &&
            File::exists(public_path($section->image))
        ){
            File::delete(public_path($section->image));
        }

        $section->delete();

        return response()->json([
            'status' => true
        ]);
    }
}
