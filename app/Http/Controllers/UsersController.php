<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        // Mock data for demonstration
        $stats = [
            'total_users' => 156,
            'active_today' => 45,
            'admin_users' => 3,
            'new_this_month' => 8
        ];

        return view('users.index', compact('stats'));
    }

    public function createUser(Request $request)
    {
        // Create user logic here
        return redirect()->back()->with('success', 'User created');
    }

    public function updateUser($id, Request $request)
    {
        // Update user logic here
        return redirect()->back()->with('success', 'User updated');
    }

    public function deactivateUser($id, Request $request)
    {
        // Deactivate user logic here
        return redirect()->back()->with('success', 'User deactivated');
    }

    public function resetPassword($id, Request $request)
    {
        // Reset password logic here
        return redirect()->back()->with('success', 'Password reset email sent');
    }

    public function getUserActivity($userId)
    {
        // Get user activity logic here
        return response()->json([
            'login_count' => 45,
            'last_login' => '2024-12-10 14:30:00',
            'failed_attempts' => 2
        ]);
    }
}
