<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        // Mock data for demonstration
        $stats = [
            'pending_requests' => 5,
            'approved_today' => 12,
            'on_leave_today' => 8,
            'avg_balance' => 18
        ];

        return view('leave.index', compact('stats'));
    }

    public function createRequest(Request $request)
    {
        // Create leave request logic here
        return redirect()->back()->with('success', 'Leave request submitted successfully');
    }

    public function approveRequest($id, Request $request)
    {
        // Approve leave request logic here
        return redirect()->back()->with('success', 'Leave request approved');
    }

    public function rejectRequest($id, Request $request)
    {
        // Reject leave request logic here
        return redirect()->back()->with('success', 'Leave request rejected');
    }

    public function getLeaveBalance($employeeId)
    {
        // Get leave balance logic here
        return response()->json([
            'annual' => 21,
            'sick' => 30,
            'maternity' => 90,
            'special' => 5
        ]);
    }
}
