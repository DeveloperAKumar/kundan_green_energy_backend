<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MainGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class MainGalleryController extends Controller
{
    public function index()
    {
        $galleries = MainGallery::latest()->get();

        return view(
            'backend.main_gallery.index',
            compact('galleries')
        );
    }

    public function create()
    {
        return view('backend.main_gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $destination = public_path('uploads/main-gallery');

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        foreach ($request->file('images') as $image) {

            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move($destination, $filename);

            MainGallery::create([
                'image'  => 'uploads/main-gallery/' . $filename,
                'status' => true,
            ]);
        }

        return redirect()
            ->route('backend.main_gallery')
            ->with('success', 'Images uploaded successfully.');
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $gallery = MainGallery::findOrFail($id);

        return view(
            'backend.main_gallery.edit',
            compact('gallery')
        );
    }

    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        $gallery = MainGallery::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {

            if (
                $gallery->image &&
                File::exists(public_path($gallery->image))
            ) {
                File::delete(public_path($gallery->image));
            }

            $file = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $destination = public_path('uploads/main-gallery');

            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $gallery->image = 'uploads/main-gallery/' . $filename;
        }

        $gallery->status = $request->status;

        $gallery->save();

        return redirect()
            ->route('backend.main_gallery')
            ->with('success', 'Gallery updated successfully.');
    }

    public function destroy(Request $request)
    {
        $gallery = MainGallery::find($request->id);

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
