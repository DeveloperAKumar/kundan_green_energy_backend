<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class BlogController extends Controller{

    public function index(){
        try{
            $blogs = Blog::get();
            return view("backend.blog.index", compact("blogs"));
        }catch(\Exception $e){
            abort('500');
        }
    }
    public function create(){
        try{
            return view("backend.blog.create");
        }catch(\Exception $e){
            abort('500');
        }
    }

    public function store(Request $request){
        $request->validate([
            'blog_title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $thumbnail = 'uploads/blogs/default.png';
        if($request->hasFile('thumbnail')){
            $path = public_path('uploads/blogs');
            $file = $request->file('thumbnail');
            $thumbnail = time() . '_' . rand(1000,9999) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $thumbnail);
            $thumbnail = 'uploads/blogs/'.$thumbnail;
        }
        Blog::create([
            'title' => $request->blog_title,
            'slug' => $slug,
            'thumbnail' => $thumbnail,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
        ]);
        return redirect()->route('backend.blog')->with('success', 'Blog created successfully.');
    }

   public function edit($id){
        try{
            $id = Crypt::decrypt($id);
            $blog = Blog::where("id", $id)->first();
            return view("backend.blog.edit", compact('blog'));
        }catch(\Exception $e){
            abort('500');
        }
    }

    public function update(Request $request, $id){
        $blog = Blog::findOrFail($id);
        $request->validate([
            'blog_title'       => 'required|string|max:255',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content'          => 'required',
            'meta_title'       => 'nullable|string|max:255',
            'meta_keyword'     => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);
        // Update slug only if title changed
        if ($blog->title != $request->blog_title) {
            $slug = Str::slug($request->blog_title);
            $originalSlug = $slug;
            $count = 1;
            while (
                Blog::where('slug', $slug)
                    ->where('id', '!=', $blog->id)
                    ->exists()
            ) {
                $slug = $originalSlug . '-' . $count++;
            }
            $blog->slug = $slug;
        }
        // Upload Thumbnail
        if ($request->hasFile('thumbnail')) { 
            $path = public_path('uploads/blogs'); 
            $file = $request->file('thumbnail');
            $fileName = time().'_'.rand(1000,9999).'.'.$file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $blog->thumbnail = 'uploads/blogs/'.$fileName;
        }
        $blog->title = $request->blog_title;
        $blog->content = $request->content;
        $blog->status = $request->status;
        $blog->meta_title = $request->meta_title;
        $blog->meta_keyword = $request->meta_keyword;
        $blog->meta_description = $request->meta_description;
        $blog->save();
        return redirect()->route('backend.blog')->with('success', 'Blog updated successfully.');
}
 
 
    public function destroy(Request $request){
        try {
            $category = Blog::findOrFail($request->id);
            $category->delete();
            return response()->json([
                'status' => true,
                'message' => 'Blog Deleted Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    


}
