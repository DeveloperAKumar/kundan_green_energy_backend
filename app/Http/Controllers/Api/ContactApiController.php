<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactApiController extends Controller
{
     public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',

            'email' => 'required|email|max:255',

            'phone' => 'required|digits:10',

            'subject' => 'required|string|max:255',

            'message' => 'required|string',

        ]);

        if ($validator->fails()) {

            return response()->json([

                'status' => false,

                'message' => $validator->errors()->first(),

                'errors' => $validator->errors()

            ], 422);

        }

        ContactEnquiry::create([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'subject' => $request->subject,

            'message' => $request->message,

            'status' => true,

        ]);

        return response()->json([

            'status' => true,

            'message' => 'Your enquiry has been submitted successfully.',

        ]);
    }
}
