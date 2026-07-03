<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutPageController extends Controller
{
     public function edit()
    {
        $about = AboutPage::first();

        if (!$about) {
            $about = AboutPage::create([
                'status' => true
            ]);
        }

        return view(
            'backend.about_page.edit',
            compact('about')
        );
    }

    public function update(Request $request)
    {
        $request->validate([
            'who_we_are_small_heading' => 'nullable|max:255',
            'who_we_are_heading' => 'nullable|max:255',
            'who_we_are_description' => 'nullable',

            'vision_small_heading' => 'nullable|max:255',
            'vision_heading' => 'nullable|max:255',
            'vision_description' => 'nullable',

            'mission_small_heading' => 'nullable|max:255',
            'mission_heading' => 'nullable|max:255',
            'mission_description' => 'nullable',

            'who_we_are_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'vision_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'mission_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
 
        ]);

        $about = AboutPage::first();

        if (!$about) {
            $about = new AboutPage();
        }

        $about->who_we_are_small_heading = $request->who_we_are_small_heading;
        $about->who_we_are_heading = $request->who_we_are_heading;
        $about->who_we_are_description = $request->who_we_are_description;

        $about->vision_small_heading = $request->vision_small_heading;
        $about->vision_heading = $request->vision_heading;
        $about->vision_description = $request->vision_description;

        $about->mission_small_heading = $request->mission_small_heading;
        $about->mission_heading = $request->mission_heading;
        $about->mission_description = $request->mission_description;
 

        // Who We Are Image
        if ($request->hasFile('who_we_are_image')) {

            if ($about->who_we_are_image &&
                File::exists(public_path($about->who_we_are_image))) {
                File::delete(public_path($about->who_we_are_image));
            }

            $file = $request->file('who_we_are_image');

            $filename = time().'_who_we_are.'.$file->getClientOriginalExtension();

            $destination = public_path('uploads/about-page');

            if (!File::exists($destination)) {
                File::makeDirectory($destination,0755,true);
            }

            $file->move($destination,$filename);

            $about->who_we_are_image = 'uploads/about-page/'.$filename;
        }

        // Vision Image
        if ($request->hasFile('vision_image')) {

            if ($about->vision_image &&
                File::exists(public_path($about->vision_image))) {
                File::delete(public_path($about->vision_image));
            }

            $file = $request->file('vision_image');

            $filename = time().'_vision.'.$file->getClientOriginalExtension();

            $destination = public_path('uploads/about-page');

            if (!File::exists($destination)) {
                File::makeDirectory($destination,0755,true);
            }

            $file->move($destination,$filename);

            $about->vision_image = 'uploads/about-page/'.$filename;
        }

        // Mission Image
        if ($request->hasFile('mission_image')) {

            if ($about->mission_image &&
                File::exists(public_path($about->mission_image))) {
                File::delete(public_path($about->mission_image));
            }

            $file = $request->file('mission_image');

            $filename = time().'_mission.'.$file->getClientOriginalExtension();

            $destination = public_path('uploads/about-page');

            if (!File::exists($destination)) {
                File::makeDirectory($destination,0755,true);
            }

            $file->move($destination,$filename);

            $about->mission_image = 'uploads/about-page/'.$filename;
        }

        $about->save();

        return redirect()
            ->route('backend.about_page.edit')
            ->with('success', 'About Page updated successfully.');
    }
}
