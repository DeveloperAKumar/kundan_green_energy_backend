<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ChairmanMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ChairmanMessageController extends Controller
{
    public function edit()
    {
        $message = ChairmanMessage::first();

        if (!$message) {

            $message = ChairmanMessage::create([
                'status' => true
            ]);

        }

        return view(
            'backend.chairman_message.edit',
            compact('message')
        );
    }

    public function update(Request $request)
    {
       $request->validate([

            'chairman_name'=>'nullable|max:255',
            'about_chairman'=>'nullable',

            'chairman_image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'md_name'=>'nullable|max:255',
            'md_message'=>'nullable',

            'md_image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
 

        ]);

        $message = ChairmanMessage::first();

        if(!$message){

            $message = new ChairmanMessage();

        }

        $message->chairman_name = $request->chairman_name;

        $message->about_chairman = $request->about_chairman;

        $message->md_name = $request->md_name;

        $message->md_message = $request->md_message;
 
if($request->hasFile('chairman_image')){

    if(
        $message->chairman_image &&
        File::exists(public_path($message->chairman_image))
    ){

        File::delete(public_path($message->chairman_image));

    }

    $destination = public_path('uploads/chairman');

    if(!File::exists($destination)){

        File::makeDirectory($destination,0755,true);

    }

    $file = $request->file('chairman_image');

    $filename = time().'_chairman.'.$file->getClientOriginalExtension();

    $file->move($destination,$filename);

    $message->chairman_image='uploads/chairman/'.$filename;

}

if($request->hasFile('md_image')){

    if(
        $message->md_image &&
        File::exists(public_path($message->md_image))
    ){

        File::delete(public_path($message->md_image));

    }

    $destination = public_path('uploads/chairman');

    if(!File::exists($destination)){

        File::makeDirectory($destination,0755,true);

    }

    $file = $request->file('md_image');

    $filename = time().'_md.'.$file->getClientOriginalExtension();

    $file->move($destination,$filename);

    $message->md_image='uploads/chairman/'.$filename;

}

        $message->save();

        return redirect()
            ->route('backend.chairman_message.edit')
            ->with('success','Record updated successfully.');
    }
}
