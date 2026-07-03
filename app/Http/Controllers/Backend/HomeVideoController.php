<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;    

class HomeVideoController extends Controller
{
     public function edit()
    {
        $homeVideo = HomeVideo::first();

        return view('backend.home_video.edit', compact('homeVideo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'video' => 'nullable|mimes:mp4,webm,ogg|max:51200',
            'status' => 'required|boolean',
        ]);

        $homeVideo = HomeVideo::first();

        if (!$homeVideo) {
            $homeVideo = new HomeVideo();
        }

        if ($request->hasFile('video')) {

            if (
                $homeVideo->video &&
                File::exists(public_path($homeVideo->video))
            ) {
                File::delete(public_path($homeVideo->video));
            }

            $file = $request->file('video');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $destination = public_path('uploads/home-video');

            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $homeVideo->video = 'uploads/home-video/'.$filename;
        }

        $homeVideo->status = $request->status;

        $homeVideo->save();

        return redirect()
            ->route('backend.home_video.edit')
            ->with('success', 'Home video updated successfully.');
    }
}
