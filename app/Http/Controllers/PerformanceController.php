<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        // Mock data for demonstration
        $stats = [
            'avg_performance' => 85,
            'top_performers' => 12,
            'need_improvement' => 8,
            'reviews_pending' => 6,
            'excellent_count' => 15,
            'good_count' => 28,
            'average_count' => 18,
            'below_average_count' => 5
        ];

        // Mock performance data
        $performances = [
            [
                'employee_name' => 'John Smith',
                'employee_id' => 'EMP001',
                'score' => 95,
                'status' => 'excellent',
                'review_date' => '2024-03-01'
            ],
            [
                'employee_name' => 'Jane Doe',
                'employee_id' => 'EMP002',
                'score' => 82,
                'status' => 'good',
                'review_date' => '2024-03-02'
            ],
            [
                'employee_name' => 'Mike Johnson',
                'employee_id' => 'EMP003',
                'score' => 68,
                'status' => 'average',
                'review_date' => '2024-03-03'
            ],
            [
                'employee_name' => 'Sarah Wilson',
                'employee_id' => 'EMP004',
                'score' => 45,
                'status' => 'below_average',
                'review_date' => '2024-03-04'
            ],
            [
                'employee_name' => 'Tom Brown',
                'employee_id' => 'EMP005',
                'score' => 88,
                'status' => 'good',
                'review_date' => '2024-03-05'
            ]
        ];

        return view('performance.index', compact('stats', 'performances'));
    }

    public function createReview(Request $request)
    {
        // Create performance review logic here
        return redirect()->back()->with('success', 'Performance review created');
    }

    public function updateReview($id, Request $request)
    {
        // Update performance review logic here
        return redirect()->back()->with('success', 'Performance review updated');
    }

    public function getEmployeePerformance($employeeId)
    {
        // Get employee performance data
        return response()->json([
            'overall_score' => 88,
            'quality_of_work' => 90,
            'teamwork' => 85,
            'innovation' => 92,
            'punctuality' => 95
        ]);
    }
}
