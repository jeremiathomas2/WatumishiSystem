<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Company;
use App\Models\LeaveRequest;
use App\Models\DisciplineCase;
use App\Models\AttendanceRecord;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get basic statistics
        $stats = [
            'total_employees' => Employee::where('company_id', $user->company_id)->count(),
            'active_employees' => Employee::where('company_id', $user->company_id)->where('status', 'active')->count(),
            'pending_leave_requests' => LeaveRequest::whereHas('employee', function($query) use ($user) {
                $query->where('company_id', $user->company_id);
            })->where('status', 'pending')->count(),
            'open_discipline_cases' => DisciplineCase::whereHas('employee', function($query) use ($user) {
                $query->where('company_id', $user->company_id);
            })->whereIn('case_status', ['reported', 'investigation', 'hearing_scheduled'])->count(),
            'total_companies' => $user->isSuperAdmin() ? Company::count() : 1,
        ];

        // Get recent activities
        $recentActivities = [
            'recent_leave_requests' => LeaveRequest::with('employee')
                ->whereHas('employee', function($query) use ($user) {
                    $query->where('company_id', $user->company_id);
                })
                ->latest()
                ->take(5)
                ->get(),
            'recent_discipline_cases' => DisciplineCase::with('employee')
                ->whereHas('employee', function($query) use ($user) {
                    $query->where('company_id', $user->company_id);
                })
                ->latest()
                ->take(5)
                ->get(),
        ];

        // Get attendance summary for today
        $todayAttendance = AttendanceRecord::with('employee')
            ->whereHas('employee', function($query) use ($user) {
                $query->where('company_id', $user->company_id);
            })
            ->whereDate('attendance_date', today())
            ->get();

        $attendanceSummary = [
            'present' => $todayAttendance->where('status', 'present')->count(),
            'absent' => $todayAttendance->where('status', 'absent')->count(),
            'late' => $todayAttendance->where('status', 'late')->count(),
            'on_leave' => $todayAttendance->where('status', 'leave')->count(),
        ];

        return view('dashboard.index', compact('stats', 'recentActivities', 'attendanceSummary'));
    }
}
