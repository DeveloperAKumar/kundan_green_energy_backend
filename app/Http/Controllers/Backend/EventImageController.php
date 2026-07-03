<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class EventImageController extends Controller
{
    public function index($eventId)
    {
        $event = Event::findOrFail($eventId);

        $images = EventImage::where('event_id',$eventId)
                    ->latest()
                    ->get();

        return view(
            'backend.event_gallery.index',
            compact('event','images')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'event_id'=>'required|exists:events,id',

            'album_name'=>'required|max:255',

            'images'=>'required',

            'images.*'=>'image|mimes:jpg,jpeg,png,webp|max:5120'

        ]);

        $destination = public_path('uploads/event-gallery');

        if(!File::exists($destination)){

            File::makeDirectory($destination,0755,true);

        }

        foreach($request->file('images') as $image){

            $filename=time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

            $image->move($destination,$filename);

            EventImage::create([

                'event_id'=>$request->event_id,

                'album_name'=>$request->album_name,

                'image'=>'uploads/event-gallery/'.$filename,

                'status'=>true

            ]);

        }

        return redirect()
            ->back()
            ->with('success','Images uploaded successfully.');

    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $image = EventImage::findOrFail($id);

        return view(
            'backend.event_gallery.edit',
            compact('image')
        );
    }

    public function update(Request $request,$id)
    {
        $id = Crypt::decrypt($id);

        $image = EventImage::findOrFail($id);

        $request->validate([

            'album_name'=>'required',

            'status'=>'required|boolean',

            'image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'

        ]);

        $image->album_name = $request->album_name;

        $image->status = $request->status;

        if($request->hasFile('image')){

            if(
                $image->image &&
                File::exists(public_path($image->image))
            ){

                File::delete(public_path($image->image));

            }

            $file = $request->file('image');

            $filename=time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $destination=public_path('uploads/event-gallery');

            $file->move($destination,$filename);

            $image->image='uploads/event-gallery/'.$filename;

        }

        $image->save();

        return redirect()
            ->route('backend.event_image',$image->event_id)
            ->with('success','Image updated successfully.');

    }

    public function destroy(Request $request)
    {
        $image = EventImage::find($request->id);

        if(!$image){

            return response()->json([
                'status'=>false
            ]);

        }

        if(
            $image->image &&
            File::exists(public_path($image->image))
        ){

            File::delete(public_path($image->image));

        }

        $image->delete();

        return response()->json([
            'status'=>true
        ]);

    }
}
