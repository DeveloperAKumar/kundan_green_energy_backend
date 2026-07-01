<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminController extends Controller{

    public function adminLogin(){
        return view('auth.login');
    }

    public function login(LoginRequest $request){   
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->route('backend.dashboard');
    }

    public function adminLoginRedirect(){ 
        return redirect()->route('admin.login_view');
    }

    public function dashboard(){
        return view("backend.dashboard.admin_dashboard");
    }

    
    public function adminProfile(){
        $profile = User::where("id", Auth::user()->id)->first();
        return view("backend.profile", compact("profile"));
    }

    public function updateAdminProfile(Request $request){
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(Auth::id()),
            ],
            'phone'         => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        try {
            $user = Auth::user();
            $profileImage = $user->profile_image;
            if ($request->hasFile('profile_image')) {
                
                $file = $request->file('profile_image');
                $fileName = time() . '_profile.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('uploads/profile');
                $file->move($destinationPath, $fileName);
                $profileImage = 'uploads/profile/' . $fileName;
            }
            $user->update([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'profile_image' => $profileImage,
            ]);
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
}
