<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class CareerController extends Controller{
    public function index(){
        $careers = Career::latest()->get();
        return view('backend.career.index', compact('careers'));
    }

    public function show($id){
        $id = Crypt::decrypt($id);
        $career = Career::findOrFail($id);
        return view('backend.career.show', compact('career'));
    }

    public function destroy(Request $request){
        $career = Career::find($request->id);
        if (!$career) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found.'
            ]);
        }
        if (
            $career->resume &&
            File::exists(public_path($career->resume))
        ) {
            File::delete(public_path($career->resume));
        }
        $career->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
