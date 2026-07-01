<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TestimonialController extends Controller
{
     public function index(){
        try{
            $testimonials = Testimonial::orderBy("id", "desc")->get();
            return view("backend.testimonial.index", compact("testimonials"));
        }catch(\Exception $e){
          abort("500");
        }
    }

    public function create(){
        try{
            $testimonial = Testimonial::where("status", 1)->get();
            return view("backend.testimonial.create", compact('testimonial'));
        }catch(\Exception $e){
            abort("500");
        }
    }

    public function edit($id){
        try {
            $id = Crypt::decrypt($id);
            $testimonial = Testimonial::findOrFail($id);
            return view('backend.testimonial.edit', compact('testimonial'));
        } catch (\Exception $e) { 
            abort(500);
        }
    }


    public function store(Request $request){
       $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            $photoPath = 'default/  user.png';
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->move(
                    public_path('uploads/testimonials'),
                    $fileName
                );
                $photoPath = 'uploads/testimonials/'.$fileName;
            }
            Testimonial::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'photo' => $photoPath,
                'review' => $request->review,
                'rating' => $request->rating,
                'status' => 1,
            ]);
            return redirect()->route('backend.testimonial')->with('created', 'Testimonial added successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id){
        $testimonial = Testimonial::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:0,1',
        ]);
        try {
            $photoPath = $testimonial->photo;
            if ($request->hasFile('photo')) { 
                $file = $request->file('photo'); 
                $fileName = time().'_'.$file->getClientOriginalName(); 
                $file->move(
                    public_path('uploads/testimonials'),
                    $fileName
                ); 
                $photoPath = 'uploads/testimonials/'.$fileName;
            }
            $testimonial->update([
                'name' => $request->name,
                'designation' => $request->designation,
                'photo' => $photoPath,
                'review' => $request->review,
                'rating' => $request->rating,
                'status' => $request->status,
            ]);
            return redirect()->route('backend.testimonial')->with('updated', 'Testimonial updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

   public function destroy(Request $request){
    try {
        $blog = Testimonial::findOrFail($request->id); 
        $blog->delete();
        return response()->json([
            'status' => true,
            'message' => 'Testimonial deleted successfully.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}
}
