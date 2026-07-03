<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContentGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class ContentGalleryController extends Controller
{
     public function index()
    {
        $galleries = ContentGallery::latest()->get();

        return view(
            'backend.content_gallery.index',
            compact('galleries')
        );
    }

    public function create()
    {
        return view('backend.content_gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $gallery = new ContentGallery();

        $gallery->heading = $request->heading;

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $destination = public_path('uploads/content-gallery');

            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $gallery->image = 'uploads/content-gallery/'.$filename;
        }

        $gallery->status = true;

        $gallery->save();

        return redirect()
            ->route('backend.content_gallery')
            ->with('success', 'Content Gallery created successfully.');
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $gallery = ContentGallery::findOrFail($id);

        return view(
            'backend.content_gallery.edit',
            compact('gallery')
        );
    }

    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        $gallery = ContentGallery::findOrFail($id);

        $request->validate([
            'heading' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'required|boolean',
        ]);

        $gallery->heading = $request->heading;
        $gallery->status = $request->status;

        if ($request->hasFile('image')) {

            if (
                $gallery->image &&
                File::exists(public_path($gallery->image))
            ) {
                File::delete(public_path($gallery->image));
            }

            $file = $request->file('image');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $destination = public_path('uploads/content-gallery');

            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $gallery->image = 'uploads/content-gallery/'.$filename;
        }

        $gallery->save();

        return redirect()
            ->route('backend.content_gallery')
            ->with('success', 'Content Gallery updated successfully.');
    }

    public function destroy(Request $request)
    {
        $gallery = ContentGallery::find($request->id);

        if (!$gallery) {

            return response()->json([
                'status' => false,
                'message' => 'Record not found.'
            ]);
        }

        if (
            $gallery->image &&
            File::exists(public_path($gallery->image))
        ) {
            File::delete(public_path($gallery->image));
        }

        $gallery->delete();

        return response()->json([
            'status' => true
        ]);
    }
}
