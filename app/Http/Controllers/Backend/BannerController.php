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
        'name'       => 'nullable|string|max:255',
        'image'      => 'required|image|mimes:jpg,jpeg,png,webp|max:6000',
        'sort_order' => 'required|integer|min:0',
    ]);
    try {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/banners');
            $file->move($destinationPath, $fileName);
            $imagePath = 'uploads/banners/' . $fileName;
        }
        Banner::create([ 
            'name'       => $request->name,
            'image'      => $imagePath,
            'sort_order' => $request->sort_order,
        ]);
        return redirect()->route("backend.banner")->with('success', 'Banner created successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', $e->getMessage());
    }
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
    $request->validate([
         'name'       => 'nullable|string|max:255',
        'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6000',
        'sort_order' => 'required|integer|min:0',
        'status'     => 'required|in:0,1',
    ]);
    try {
        $banner = Banner::findOrFail($id);
        $imagePath = $banner->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/banners');
            $file->move($destinationPath, $fileName);
            $imagePath = 'uploads/banners/' . $fileName;
        }
        $banner->update([ 
            'name'       => $request->name,
            'image'      => $imagePath, 
            'sort_order' => $request->sort_order,
            'status'     => $request->status,
        ]);
        return redirect()->route('backend.banner')->with('success', 'Banner updated successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', $e->getMessage());
    }
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
