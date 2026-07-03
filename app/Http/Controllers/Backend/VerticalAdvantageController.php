<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vertical;
use App\Models\VerticalAdvantage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class VerticalAdvantageController extends Controller
{
     public function index()
    {
        $advantages = VerticalAdvantage::with('vertical')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view(
            'backend.vertical_advantage.index',
            compact('advantages')
        );
    }

    public function create()
    {
        $verticals = Vertical::where('status',1)
            ->orderBy('name')
            ->get();

        return view(
            'backend.vertical_advantage.create',
            compact('verticals')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'vertical_id' => 'required|exists:verticals,id',
            'title' => 'required|max:255',
            'description' => 'required',
            'sort_order' => 'required|integer',
        ]);

        VerticalAdvantage::create([
            'vertical_id' => $request->vertical_id,
            'title' => $request->title,
            'description' => $request->description,
            'sort_order' => $request->sort_order,
            'status' => true,
        ]);

        return redirect()
            ->route('backend.vertical_advantage')
            ->with('success','Advantage created successfully.');
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $advantage = VerticalAdvantage::findOrFail($id);

        $verticals = Vertical::where('status',1)
            ->orderBy('name')
            ->get();

        return view(
            'backend.vertical_advantage.edit',
            compact('advantage','verticals')
        );
    }

    public function update(Request $request,$id)
    {
        $id = Crypt::decrypt($id);

        $advantage = VerticalAdvantage::findOrFail($id);

        $request->validate([
            'vertical_id' => 'required|exists:verticals,id',
            'title' => 'required|max:255',
            'description' => 'required',
            'sort_order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $advantage->vertical_id = $request->vertical_id;
        $advantage->title = $request->title;
        $advantage->description = $request->description;
        $advantage->sort_order = $request->sort_order;
        $advantage->status = $request->status;

        $advantage->save();

        return redirect()
            ->route('backend.vertical_advantage')
            ->with('success','Advantage updated successfully.');
    }

    public function destroy(Request $request)
    {
        $advantage = VerticalAdvantage::find($request->id);

        if(!$advantage){

            return response()->json([
                'status'=>false,
                'message'=>'Record not found.'
            ]);

        }

        $advantage->delete();

        return response()->json([
            'status'=>true
        ]);
    }
}
