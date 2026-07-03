<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\EventSession; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventController extends Controller{
private function generateUniqueSlug($title, $id = null)
{
    $slug = Str::slug($title);

    $originalSlug = $slug;

    $count = 1;

    while (
        Event::where('slug', $slug)
            ->when($id, function ($query) use ($id) {
                $query->where('id', '!=', $id);
            })
            ->exists()
    ) {

        $slug = $originalSlug . '-' . $count;

        $count++;
    }

    return $slug;
}
 public function index()
    {
        $events = Event::latest()->get();

        return view(
            'backend.event.index',
            compact('events')
        );
    }

    public function create()
    {
        return view('backend.event.create');
    }

   public function store(Request $request)
{
    $request->validate([

        'title' => 'required|max:255',

        'date' => 'required|date',

        'description' => 'required',

        'meta_title' => 'nullable|max:255',

        'meta_keyword' => 'nullable',

        'meta_description' => 'nullable',

        'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',

    ]);

    $event = new Event();

    $event->title = $request->title;

    $event->slug = $this->generateUniqueSlug($request->title);

    $event->date = $request->date;

    $event->description = $request->description;

    $event->meta_title = $request->meta_title;

    $event->meta_keyword = $request->meta_keyword;

    $event->meta_description = $request->meta_description;

    if ($request->hasFile('thumbnail')) {

        $destination = public_path('uploads/events');

        if (!File::exists($destination)) {

            File::makeDirectory($destination, 0755, true);

        }

        $file = $request->file('thumbnail');

        $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

        $file->move($destination, $filename);

        $event->thumbnail = 'uploads/events/'.$filename;
    }

    $event->status = true;

    $event->save();

    return redirect()
        ->route('backend.event')
        ->with('success', 'Event created successfully.');
}

    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $event = Event::findOrFail($id);

        return view(
            'backend.event.edit',
            compact('event')
        );
    }

    public function update(Request $request,$id)
    {
        $id = Crypt::decrypt($id);

        $event = Event::findOrFail($id);

       $request->validate([

    'title' => 'required|max:255',

    'date' => 'required|date',

    'description' => 'required',

    'meta_title' => 'nullable|max:255',

    'meta_keyword' => 'nullable',

    'meta_description' => 'nullable',

    'status' => 'required|boolean',

    'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

]);

        $event->title = $request->title;

$event->slug = $this->generateUniqueSlug($request->title, $event->id);

$event->date = $request->date;

$event->description = $request->description;

$event->meta_title = $request->meta_title;

$event->meta_keyword = $request->meta_keyword;

$event->meta_description = $request->meta_description;

$event->status = $request->status;

        if($request->hasFile('thumbnail')){

            if(
                $event->thumbnail &&
                File::exists(public_path($event->thumbnail))
            ){

                File::delete(public_path($event->thumbnail));

            }

            $destination = public_path('uploads/events');

            if(!File::exists($destination)){

                File::makeDirectory($destination,0755,true);

            }

            $file = $request->file('thumbnail');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $file->move($destination,$filename);

            $event->thumbnail = 'uploads/events/'.$filename;

        }

        $event->save();

        return redirect()
            ->route('backend.event')
            ->with('success','Event updated successfully.');

    }

    public function destroy(Request $request)
    {
        $event = Event::find($request->id);

        if(!$event){

            return response()->json([

                'status'=>false,

                'message'=>'Record not found.'

            ]);

        }

        if(
            $event->thumbnail &&
            File::exists(public_path($event->thumbnail))
        ){

            File::delete(public_path($event->thumbnail));

        }

        $event->delete();

        return response()->json([

            'status'=>true

        ]);

    }
         
}
