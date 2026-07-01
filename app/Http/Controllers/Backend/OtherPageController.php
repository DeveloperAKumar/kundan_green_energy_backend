<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OtherPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class OtherPageController extends Controller{

    public function index(){
        try{
            $pages = OtherPage::get();
            return view("backend.other_page.index", compact("pages"));
        }catch(\Exception $e){
            abort('500');
        }
    }
    public function create(){
        try{
            return view("backend.other_page.create");
        }catch(\Exception $e){
            abort('500');
        }
    }

  public function store(Request $request){
    $request->validate([
        'page_name'        => 'required|string|max:255|unique:other_pages,name',
        'content'          => 'required',
        'meta_title'       => 'nullable|string|max:255',
        'meta_keyword'     => 'nullable|string',
        'meta_description' => 'nullable|string',
    ]);
    $slug = Str::slug($request->page_name);
    $originalSlug = $slug;
    $count = 1;
    while (OtherPage::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $count;
        $count++;
    }
    OtherPage::create([
        'name'        => $request->page_name,
        'slug'             => $slug,
        'content'          => $request->content,
        'meta_title'       => $request->meta_title,
        'meta_keyword'     => $request->meta_keyword,
        'meta_description' => $request->meta_description,
        'published_by' => Auth::user()->id
    ]);
    return redirect()->route('backend.other_page')->with('success', 'Page created successfully.');
}

   public function edit($id){
        try{
            $id = Crypt::decrypt($id);
            $page = OtherPage::where("id", $id)->first();
            return view("backend.other_page.edit", compact('page'));
        }catch(\Exception $e){
            abort('500');
        }
    }




    public function update(Request $request, $id){
        $page = OtherPage::findOrFail($id);
        $request->validate([
            'page_name'        => 'required|string|max:255|unique:other_pages,name,' . $page->id,
            'content'          => 'required',
            'status'           => 'required|in:0,1',
            'meta_title'       => 'nullable|string|max:255',
            'meta_keyword'     => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);
        if ($page->page_name != $request->page_name) {
            $slug = Str::slug($request->page_name);
            $originalSlug = $slug;
            $count = 1;
            while (
                OtherPage::where('slug', $slug)
                    ->where('id', '!=', $page->id)
                    ->exists()
            ) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $page->slug = $slug;
        }
        $page->name = $request->page_name;
        $page->content = $request->content;
        $page->status = $request->status;
        $page->meta_title = $request->meta_title;
        $page->meta_keyword = $request->meta_keyword;
        $page->meta_description = $request->meta_description;
        $page->save();
        return redirect()->route('backend.other_page')->with('success', 'Page updated successfully.');
    }
 
 
    public function destroy(Request $request){
        try {
            $category = OtherPage::findOrFail($request->id);
            $category->delete();
            return response()->json([
                'status' => true,
                'message' => 'Page Deleted Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
