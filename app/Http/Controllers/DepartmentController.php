<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        // Mock data for demonstration
        $stats = [
            'total_departments' => 8,
            'avg_team_size' => 19,
            'total_managers' => 8,
            'budget_utilization' => 78
        ];

        $departments = [
            (object)[
                'id' => 1,
                'name' => 'Information Technology',
                'description' => 'Manages all technology infrastructure and software development',
                'manager_name' => 'John Smith',
                'employee_count' => 25,
                'budget' => 5000000,
                'status' => 'active'
            ],
            (object)[
                'id' => 2,
                'name' => 'Human Resources',
                'description' => 'Handles recruitment, employee relations, and training',
                'manager_name' => 'Sarah Johnson',
                'employee_count' => 12,
                'budget' => 2000000,
                'status' => 'active'
            ],
            (object)[
                'id' => 3,
                'name' => 'Finance',
                'description' => 'Manages financial planning, accounting, and budgeting',
                'manager_name' => 'Michael Brown',
                'employee_count' => 18,
                'budget' => 3500000,
                'status' => 'active'
            ],
            (object)[
                'id' => 4,
                'name' => 'Operations',
                'description' => 'Oversees daily operations and logistics',
                'manager_name' => 'Emily Davis',
                'employee_count' => 32,
                'budget' => 4500000,
                'status' => 'active'
            ],
            (object)[
                'id' => 5,
                'name' => 'Marketing',
                'description' => 'Handles marketing strategies and brand management',
                'manager_name' => 'David Wilson',
                'employee_count' => 15,
                'budget' => 3000000,
                'status' => 'active'
            ],
            (object)[
                'id' => 6,
                'name' => 'Sales',
                'description' => 'Manages sales operations and customer relationships',
                'manager_name' => 'Lisa Anderson',
                'employee_count' => 28,
                'budget' => 4000000,
                'status' => 'active'
            ]
        ];

        return view('department.index', compact('stats', 'departments'));
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        // Validation and storage logic here
        return redirect()->route('departments.index')->with('success', 'Department created successfully');
    }

    public function show($id)
    {
        $department = Department::find($id);
        return view('department.show', compact('department'));
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('department.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        // Update logic here
        return redirect()->route('departments.index')->with('success', 'Department updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic here
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully');
    }
}
