<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SocialMediaController extends Controller{

     public function index(){
        try{
            $social_media = SocialMedia::get();
            return view("backend.social_media.index", compact("social_media"));
        }catch(\Exception $e){
            abort('500');
        }
    }
    
    public function create(){
        try{
            return view("backend.social_media.create");
        }catch(\Exception $e){
            abort('500');
        }
    }

public function store(Request $request){
    $request->validate([
        'name' => 'required|string|max:255|unique:social_media,name',
        'icon' => 'required|string|max:255',
        'url'  => 'required|max:255',
    ]);
    SocialMedia::create([
        'name'   => $request->name,
        'icon'   => $request->icon,
        'url'    => $request->url,
        'status' => 1,
    ]);
    return redirect()->route('backend.social_media')->with('success', 'Social media created successfully.');
}


   public function edit($id){
        try{
            $id = Crypt::decrypt($id);
            $social_media = SocialMedia::where("id", $id)->first();
            return view("backend.social_media.edit", compact('social_media'));
        }catch(\Exception $e){
            abort('500');
        }
    }




    public function update(Request $request, $id){
        $socialMedia = SocialMedia::findOrFail($id);
        $request->validate([
            'name'   => 'required|string|max:255|unique:social_media,name,' . $socialMedia->id,
            'icon'   => 'required|string|max:255',
            'url'    => 'required|max:255',
            'status' => 'required|in:0,1',
        ]);
        $socialMedia->update([
            'name'   => $request->name,
            'icon'   => $request->icon,
            'url'    => $request->url,
            'status' => $request->status,
        ]);
        return redirect()->route('backend.social_media')->with('success', 'Social media updated successfully.');
    }
 
 
    public function destroy(Request $request){
        try {
            $category = SocialMedia::findOrFail($request->id);
            $category->delete();
            return response()->json([
                'status' => true,
                'message' => 'Link Deleted Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    
}

}