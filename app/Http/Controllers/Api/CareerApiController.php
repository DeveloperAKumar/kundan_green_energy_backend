<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class CareerApiController extends Controller
{
     public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',

            'email' => 'required|email|max:255',

            'phone' => 'required|digits:10',

            'position' => 'required|string|max:255',

            'message' => 'nullable|string',

            'resume' => 'required|mimes:pdf,doc,docx|max:5120',

        ]);

        if ($validator->fails()) {

            return response()->json([

                'status' => false,

                'message' => $validator->errors()->first(),

                'errors' => $validator->errors()

            ],422);

        }

        $career = new Career();

        $career->name = $request->name;

        $career->email = $request->email;

        $career->phone = $request->phone;

        $career->position = $request->position;

        $career->message = $request->message;

        if($request->hasFile('resume')){

            $destination = public_path('uploads/resume');

            if(!File::exists($destination)){

                File::makeDirectory($destination,0755,true);

            }

            $file = $request->file('resume');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $file->move($destination,$filename);

            $career->resume = 'uploads/resume/'.$filename;

        }

        $career->status = true;

        $career->save();

        return response()->json([

            'status'=>true,

            'message'=>'Application submitted successfully.'

        ]);

    }
}
