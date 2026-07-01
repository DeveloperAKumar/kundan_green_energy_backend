<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function edit(){
        try {
            $setting = SiteSetting::first();
            if (!$setting) {
                $setting = SiteSetting::create([
                    'company_name' => '',
                    'meta_description' => '',
                ]);
            }
            return view('backend.site_setting.edit', compact('setting'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function update(Request $request){
        $request->validate([
            'company_name'     => 'nullable|string|max:255',
            'primary_phone'    => 'nullable|string|max:50',
            'primary_email'    => 'nullable|email|max:255',
            'address'          => 'nullable|string',
            'copyright_text'   => 'nullable|string',
            'google_map'       => 'nullable|string',
            'meta_title'       => 'nullable|string|max:255',
            'meta_keyword'     => 'nullable|string',
            'meta_description' => 'nullable|string',
            'logo_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon'          => 'nullable|image|mimes:jpg,jpeg,png,ico,webp|max:1024',
        ]);
        try {
            $setting = SiteSetting::first();
            $logo = $setting->logo_image;
            $favicon = $setting->favicon;
            if ($request->hasFile('logo_image')) {
                $file = $request->file('logo_image');
                $fileName = time().'_logo.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/site-setting'), $fileName);
                $logo = 'uploads/site-setting/'.$fileName;
            }
            if ($request->hasFile('favicon')) {
                $file = $request->file('favicon');
                $fileName = time().'_favicon.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/site-setting'), $fileName);
                $favicon = 'uploads/site-setting/'.$fileName;
            }
            $setting->update([
                'company_name'     => $request->company_name,
                'logo_image'       => $logo,
                'favicon'          => $favicon,
                'primary_phone'    => $request->primary_phone,
                'primary_email'    => $request->primary_email,
                'address'          => $request->address,
                'copyright_text'   => $request->copyright_text,
                'google_map'       => $request->google_map,
                'meta_title'       => $request->meta_title,
                'meta_keyword'     => $request->meta_keyword,
                'meta_description' => $request->meta_description,
            ]);
            return redirect()->back()->with('success', 'Site Settings updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }


}
