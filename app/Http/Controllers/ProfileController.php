<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = DB::table('users')->where('id', Auth::id())->first();
        return view('admin.profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'required',
            'profile_image' => 'nullable|image|max:2048'
        ]);

        $user = DB::table('users')->where('id', Auth::id())->first();

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // Handle image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image && Storage::disk('public')->exists(str_replace('/storage/', '', $user->profile_image))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $user->profile_image));
            }

            $path = $request->file('profile_image')->store('uploads', 'public');
            $data['profile_image'] = Storage::url($path);
        }

        DB::table('users')->where('id', Auth::id())->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        $user = DB::table('users')->where('id', Auth::id())->first();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $newPassword = Hash::make($request->new_password);

        DB::table('users')->where('id', Auth::id())->update([
            'password' => $newPassword
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
