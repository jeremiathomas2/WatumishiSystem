<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        // Mock data for demonstration
        $stats = [
            'active_programs' => 6,
            'employees_trained' => 89,
            'completion_rate' => 85,
            'certifications' => 34
        ];

        $trainingPrograms = [
            (object)[
                'id' => 1,
                'title' => 'Advanced JavaScript Development',
                'category' => 'Technical Skills',
                'description' => 'Comprehensive training on modern JavaScript frameworks and best practices for web development.',
                'duration' => '8 weeks',
                'instructor' => 'John Smith',
                'enrolled_count' => 12,
                'capacity' => 15,
                'status' => 'active',
                'progress' => 65
            ],
            (object)[
                'id' => 2,
                'title' => 'Leadership Excellence Program',
                'category' => 'Management',
                'description' => 'Develop essential leadership skills and management techniques for team leaders and supervisors.',
                'duration' => '6 weeks',
                'instructor' => 'Sarah Johnson',
                'enrolled_count' => 8,
                'capacity' => 10,
                'status' => 'active',
                'progress' => 40
            ],
            (object)[
                'id' => 3,
                'title' => 'Workplace Safety Training',
                'category' => 'Compliance',
                'description' => 'Mandatory safety training covering workplace hazards, emergency procedures, and safety protocols.',
                'duration' => '2 days',
                'instructor' => 'Michael Brown',
                'enrolled_count' => 25,
                'capacity' => 30,
                'status' => 'active',
                'progress' => 80
            ],
            (object)[
                'id' => 4,
                'title' => 'Financial Management Basics',
                'category' => 'Finance',
                'description' => 'Introduction to financial concepts, budgeting, and financial reporting for non-finance staff.',
                'duration' => '4 weeks',
                'instructor' => 'Emily Davis',
                'enrolled_count' => 15,
                'capacity' => 20,
                'status' => 'active',
                'progress' => 55
            ],
            (object)[
                'id' => 5,
                'title' => 'Customer Service Excellence',
                'category' => 'Soft Skills',
                'description' => 'Enhance customer service skills and learn best practices for handling customer interactions.',
                'duration' => '3 weeks',
                'instructor' => 'David Wilson',
                'enrolled_count' => 18,
                'capacity' => 25,
                'status' => 'active',
                'progress' => 30
            ],
            (object)[
                'id' => 6,
                'title' => 'Project Management Fundamentals',
                'category' => 'Management',
                'description' => 'Learn project management methodologies, tools, and techniques for successful project delivery.',
                'duration' => '5 weeks',
                'instructor' => 'Lisa Anderson',
                'enrolled_count' => 10,
                'capacity' => 12,
                'status' => 'active',
                'progress' => 70
            ]
        ];

        return view('training.index', compact('stats', 'trainingPrograms'));
    }

    public function create()
    {
        return view('training.create');
    }

    public function store(Request $request)
    {
        // Validation and storage logic here
        return redirect()->route('training.index')->with('success', 'Training program created successfully');
    }

    public function show($id)
    {
        return view('training.show', ['programId' => $id]);
    }

    public function edit($id)
    {
        return view('training.edit', ['programId' => $id]);
    }

    public function update(Request $request, $id)
    {
        // Update logic here
        return redirect()->route('training.index')->with('success', 'Training program updated successfully');
    }

    public function participants($id)
    {
        return view('training.participants', ['programId' => $id]);
    }

    public function materials()
    {
        return view('training.materials');
    }
}
