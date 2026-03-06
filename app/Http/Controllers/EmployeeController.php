<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;

class EmployeeController extends Controller
{
    public function index()
    {
        // Mock data for demonstration
        $stats = [
            'total_employees' => 156,
            'active_employees' => 142,
            'new_employees' => 8,
            'on_leave' => 6
        ];

        $employees = collect([
            (object)[
                'id' => 1,
                'employee_id' => 'EMP0001',
                'name' => 'John Smith',
                'email' => 'john.smith@watumishi.com',
                'department' => 'IT Department',
                'position' => 'Senior Developer',
                'status' => 'active',
                'join_date' => '2022-01-15'
            ],
            (object)[
                'id' => 2,
                'employee_id' => 'EMP0002',
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@watumishi.com',
                'department' => 'HR Department',
                'position' => 'HR Manager',
                'status' => 'active',
                'join_date' => '2021-06-20'
            ],
            (object)[
                'id' => 3,
                'employee_id' => 'EMP0003',
                'name' => 'Michael Brown',
                'email' => 'michael.brown@watumishi.com',
                'department' => 'Finance Department',
                'position' => 'Accountant',
                'status' => 'active',
                'join_date' => '2023-03-10'
            ],
            (object)[
                'id' => 4,
                'employee_id' => 'EMP0004',
                'name' => 'Emily Davis',
                'email' => 'emily.davis@watumishi.com',
                'department' => 'Operations',
                'position' => 'Operations Manager',
                'status' => 'on_leave',
                'join_date' => '2020-11-05'
            ],
            (object)[
                'id' => 5,
                'employee_id' => 'EMP0005',
                'name' => 'David Wilson',
                'email' => 'david.wilson@watumishi.com',
                'department' => 'Marketing',
                'position' => 'Marketing Specialist',
                'status' => 'active',
                'join_date' => '2022-08-12'
            ]
        ]);

        return view('employee.index', compact('stats', 'employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        // Validation and storage logic here
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        // Update logic here
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    public function destroy($id)
    {
        // Delete logic here
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
