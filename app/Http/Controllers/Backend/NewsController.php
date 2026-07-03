<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function index(){
        $news = News::latest()->get();
        return view('backend.news.index', compact('news'));
    }

    public function create(){
        return view('backend.news.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'url' => 'nullable|url|max:500',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $news = new News();

        $news->title = $request->title;
        $news->description = $request->description;
        $news->url = $request->url;
        $news->date = $request->date;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $destination = public_path('uploads/news');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $news->image = 'uploads/news/'.$filename;
        }
        $news->status = 1;
        $news->save();
        return redirect()->route('backend.news')->with('success', 'News created successfully.');
    }

    public function edit($id){
        $id = Crypt::decrypt($id);
        $news = News::findOrFail($id);
        return view('backend.news.edit', compact('news'));
    }

    public function update(Request $request, $id){
        $id = Crypt::decrypt($id);
        $news = News::findOrFail($id);
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'url' => 'nullable|url|max:500',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'required|boolean',
        ]);

        $news->title = $request->title;
        $news->description = $request->description;
        $news->url = $request->url;
        $news->date = $request->date;
        $news->status = $request->status;

        if ($request->hasFile('image')) {
            if ($news->image && File::exists(public_path($news->image))) {
                File::delete(public_path($news->image));
            }
            $file = $request->file('image');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $destination = public_path('uploads/news');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $news->image = 'uploads/news/'.$filename;
        }
        $news->save();
        return redirect()->route('backend.news')->with('success', 'News updated successfully.');
    }

    public function destroy(Request $request){
        $news = News::find($request->id);
        if (!$news) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found.'
            ]);
        }
        if ($news->image && File::exists(public_path($news->image))) {
            File::delete(public_path($news->image));
        }
        $news->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
