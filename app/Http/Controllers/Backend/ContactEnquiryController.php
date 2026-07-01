<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;
use Illuminate\Http\Request;

class ContactEnquiryController extends Controller
{
     public function index(){
        try{
            $enquiries = ContactEnquiry::orderBy("id", "desc")->get();
            return view("backend.contact_enquiry.index", compact("enquiries"));
        }catch(\Exception $e){
          abort("500");
        }
    }
  
    public function destroy(Request $request){
        try{
            $category = ContactEnquiry::findOrFail($request->id);
            $category->delete();
            return response()->json([
                "status" => true,
                "message" => "Enquiry Deleted"
            ]);
        }catch(\Exception $e){
            return response()->json([
                "status" => false,
                "error" => $e->getMessage()
            ]);
        }
    }
}
