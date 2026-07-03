<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ValuedPartnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ValuedPartnershipController extends Controller
{
    public function index(){
        $partnerships = ValuedPartnership::latest()->get();
        return view('backend.valued-partnership.index', compact('partnerships'));
    }

    public function create(){
        return view('backend.valued-partnership.create');
    }

    public function store(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120'
        ]);
        $partnership = new ValuedPartnership();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $destination = public_path('uploads/valued-partnership');
            $file->move($destination,$filename);
            $partnership->image = 'uploads/valued-partnership/'.$filename;
        }
        $partnership->status = 1;
        $partnership->save();
        return redirect()->route('backend.valued_partnership')->with('success','Valued Partnership created successfully.');
    }

    public function edit($id){
        $id = Crypt::decrypt($id);
        $partnership = ValuedPartnership::findOrFail($id);
        return view('backend.valued-partnership.edit', compact('partnership'));
    }

    public function update(Request $request, $id){
        $id = Crypt::decrypt($id);
        $partnership = ValuedPartnership::findOrFail($id);
       $request->validate([
    'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
    'status' => 'required|boolean',
]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $destination = public_path('uploads/valued-partnership');
            $file->move($destination,$filename);
            $partnership->image = 'uploads/valued-partnership/'.$filename;
        }
        $partnership->status = $request->status;
        $partnership->save();
        return redirect()->route('backend.valued_partnership')->with('success','Valued Partnership updated successfully.');
    }

    public function destroy(Request $request){
        $partnership = ValuedPartnership::find($request->id);
        if (!$partnership) {
            return response()->json([
                'status'=>false,
                'message'=>'Record not found.'
            ]);
        }
        $partnership->delete();
        return response()->json([
            'status'=>true
        ]);
    }
}
