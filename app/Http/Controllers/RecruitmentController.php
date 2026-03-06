<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    public function index()
    {
        // Mock data for demonstration
        $stats = [
            'open_positions' => 12,
            'total_applications' => 156,
            'in_progress' => 45,
            'hired_this_month' => 8
        ];

        $jobPostings = [
            (object)[
                'id' => 1,
                'title' => 'Senior Software Developer',
                'department' => 'IT Department',
                'description' => 'We are looking for an experienced software developer to join our growing team. You will be responsible for developing and maintaining web applications using modern technologies.',
                'location' => 'Dar es Salaam',
                'type' => 'Full-time',
                'salary' => 2500000,
                'status' => 'active',
                'application_count' => 23
            ],
            (object)[
                'id' => 2,
                'title' => 'HR Manager',
                'department' => 'Human Resources',
                'description' => 'Seeking an experienced HR Manager to lead our human resources department and implement effective HR strategies.',
                'location' => 'Dar es Salaam',
                'type' => 'Full-time',
                'salary' => 2000000,
                'status' => 'active',
                'application_count' => 18
            ],
            (object)[
                'id' => 3,
                'title' => 'Marketing Specialist',
                'department' => 'Marketing',
                'description' => 'Looking for a creative marketing specialist to develop and execute marketing campaigns.',
                'location' => 'Dar es Salaam',
                'type' => 'Full-time',
                'salary' => 1500000,
                'status' => 'active',
                'application_count' => 31
            ],
            (object)[
                'id' => 4,
                'title' => 'Financial Analyst',
                'department' => 'Finance',
                'description' => 'We need a detail-oriented financial analyst to help with financial planning and analysis.',
                'location' => 'Dar es Salaam',
                'type' => 'Full-time',
                'salary' => 1800000,
                'status' => 'active',
                'application_count' => 15
            ]
        ];

        return view('recruitment.index', compact('stats', 'jobPostings'));
    }

    public function createJob()
    {
        return view('recruitment.create-job');
    }

    public function storeJob(Request $request)
    {
        // Validation and storage logic here
        return redirect()->route('recruitment.index')->with('success', 'Job posted successfully');
    }

    public function showJob($id)
    {
        return view('recruitment.show-job', ['jobId' => $id]);
    }

    public function applications()
    {
        return view('recruitment.applications');
    }

    public function showApplication($id)
    {
        return view('recruitment.show-application', ['applicationId' => $id]);
    }
}
