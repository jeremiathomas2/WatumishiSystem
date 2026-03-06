<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        // Mock data for demonstration
        $stats = [
            'present_today' => 142,
            'late_today' => 8,
            'absent_today' => 6,
            'on_leave_today' => 3,
            'weekly_present_rate' => 85,
            'weekly_late_rate' => 8,
            'weekly_absent_rate' => 7
        ];

        // Mock attendance data
        $attendances = [
            [
                'employee_name' => 'John Smith',
                'employee_id' => 'EMP001',
                'check_in' => '08:45',
                'check_out' => '17:30',
                'status' => 'present'
            ],
            [
                'employee_name' => 'Jane Doe',
                'employee_id' => 'EMP002',
                'check_in' => '09:15',
                'check_out' => '17:45',
                'status' => 'late'
            ],
            [
                'employee_name' => 'Mike Johnson',
                'employee_id' => 'EMP003',
                'check_in' => '--:--',
                'check_out' => '--:--',
                'status' => 'absent'
            ],
            [
                'employee_name' => 'Sarah Wilson',
                'employee_id' => 'EMP004',
                'check_in' => '--:--',
                'check_out' => '--:--',
                'status' => 'leave'
            ]
        ];

        // Mock department stats
        $departmentStats = [
            [
                'name' => 'IT Department',
                'present' => 25,
                'total' => 28,
                'attendance_rate' => 89
            ],
            [
                'name' => 'HR Department',
                'present' => 12,
                'total' => 14,
                'attendance_rate' => 86
            ],
            [
                'name' => 'Finance',
                'present' => 18,
                'total' => 20,
                'attendance_rate' => 90
            ]
        ];

        return view('attendance.index', compact('stats', 'attendances', 'departmentStats'));
    }

    public function markAttendance(Request $request)
    {
        // Mark attendance logic here
        return redirect()->back()->with('success', 'Attendance marked successfully');
    }

    public function getAttendanceReport(Request $request)
    {
        // Generate attendance report
        return response()->download('attendance-report.pdf');
    }
}
