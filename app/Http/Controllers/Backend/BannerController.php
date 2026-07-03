<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BannerController extends Controller{

    public function index(){
        try{
            $banners = Banner::orderBy("id", "desc")->get();
            return view("backend.banner.index", compact("banners"));
        }catch(\Exception $e){
          abort("500");
        }
    }

      public function create(){
        try{
            return view("backend.banner.create");
        }catch(\Exception $e){
            abort("500");
        }
    }

 public function store(Request $request){
    $request->validate([
        'heading' => 'required|string|max:255',
        'sub_heading' => 'required|string|max:255',
        'banner_type' => 'required|in:image,video',
        'image' => [
            'required',
            function ($attribute, $value, $fail) use ($request) {
                if (!$value) {
                    $fail('Please select a file.');
                    return;
                }
                $extension = strtolower($value->getClientOriginalExtension());
                if ($request->banner_type == 'image') {
                    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
                    if (!in_array($extension, $allowed)) {
                        $fail('Only JPG, JPEG, PNG and WEBP images are allowed.');
                    }
                } elseif ($request->banner_type == 'video') {
                    $allowed = ['mp4', 'webm', 'ogg'];
                    if (!in_array($extension, $allowed)) {
                        $fail('Only MP4, WEBM and OGG videos are allowed.');
                    }
                }
            }
        ],
    ]);
    $banner = new Banner();
    $banner->heading = $request->heading;
    $banner->sub_heading = $request->sub_heading;
    $banner->type = $request->banner_type;
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('uploads/banner');
        $file->move($destinationPath, $filename);
        $banner->file = 'uploads/banner/'.$filename;
    }
    $banner->save();
    return redirect()->route('backend.banner')->with('success', 'Banner created successfully.');
}


public function edit($id){
    try {
        $id = Crypt::decrypt($id);
        $banner = Banner::findOrFail($id);
        return view('backend.banner.edit', compact('banner'));
    }catch (\Exception $e){
        return $e->getMessage();
        abort(404);
    }
}

public function update(Request $request, $id){
    $id = Crypt::decrypt($id);
    $banner = Banner::findOrFail($id);
    $request->validate([
        'heading' => 'required|string|max:255',
        'sub_heading' => 'required|string|max:255',
        'banner_type' => 'required|in:image,video',
        'image' => [
            'nullable',
            function ($attribute, $value, $fail) use ($request) {
                if (!$value) {
                    return;
                }
                $extension = strtolower($value->getClientOriginalExtension());
                if ($request->banner_type == 'image') {
                    $allowed = ['jpg','jpeg','png','webp'];
                    if (!in_array($extension, $allowed)) {
                        $fail('Only JPG, JPEG, PNG and WEBP images are allowed.');
                    }
                } else {
                    $allowed = ['mp4','webm','ogg'];
                    if (!in_array($extension, $allowed)) {
                        $fail('Only MP4, WEBM and OGG videos are allowed.');
                    }
                }
            }
        ]
    ]);
    $banner->heading = $request->heading;
    $banner->sub_heading = $request->sub_heading;
    $banner->type = $request->banner_type;
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('uploads/banner');
        $file->move($destinationPath,$filename);
        $banner->file = 'uploads/banner/'.$filename;
    }
    $banner->save();
    return redirect()->route('backend.banner')->with('success','Banner updated successfully.');
}

public function destroy(Request $request){
        try {
            $banner = Banner::findOrFail($request->id);
            $banner->delete();
            return response()->json([
                'status' => true,
                'message' => 'Banner Deleted Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
