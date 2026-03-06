<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        // Mock data for demonstration
        $stats = [
            'system_health' => 98,
            'storage_used' => 38,
            'active_users' => 45,
            'uptime' => 99.5
        ];

        return view('settings.index', compact('stats'));
    }

    public function updateSettings(Request $request)
    {
        // Update settings logic here
        return redirect()->back()->with('success', 'Settings updated');
    }

    public function resetCache()
    {
        // Reset cache logic here
        return redirect()->back()->with('success', 'Cache cleared');
    }

    public function optimizeDatabase()
    {
        // Database optimization logic here
        return redirect()->back()->with('success', 'Database optimized');
    }

    public function createBackup()
    {
        // Create backup logic here
        return redirect()->back()->with('success', 'Backup created');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('settings.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
        ]);

        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Handle photo upload
        if ($request->hasFile('profile_photo')) {
            $photo = $request->file('profile_photo');
            
            // Create directory if it doesn't exist
            $path = public_path('storage/profile_photos');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            // Generate unique filename
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
            
            // Move uploaded file
            $photo->move($path, $filename);
            
            // Update user profile photo
            $user->update(['profile_photo' => $filename]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function changePassword()
    {
        return view('settings.change-password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password changed successfully');
    }

    public function notifications()
    {
        $user = Auth::user();
        
        // Mock notifications data
        $notifications = [
            ['id' => 1, 'title' => 'System Update', 'message' => 'System will be updated tonight', 'time' => '2 hours ago', 'read' => false],
            ['id' => 2, 'title' => 'New Employee', 'message' => 'John Doe joined the team', 'time' => '1 day ago', 'read' => false],
            ['id' => 3, 'title' => 'Leave Request', 'message' => 'Your leave request was approved', 'time' => '2 days ago', 'read' => true],
            ['id' => 4, 'title' => 'Report Ready', 'message' => 'Monthly report is ready', 'time' => '3 days ago', 'read' => true],
        ];

        return view('settings.notifications', compact('user', 'notifications'));
    }

    public function markNotificationsRead()
    {
        $user = Auth::user();
        
        // Mark all notifications as read logic here
        return response()->json(['success' => true, 'message' => 'All notifications marked as read']);
    }
}
