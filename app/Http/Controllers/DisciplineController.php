<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function index()
    {
        // Mock data for demonstration
        $stats = [
            'open_cases' => 3,
            'under_review' => 2,
            'hearing_scheduled' => 1,
            'closed_cases' => 25
        ];

        return view('discipline.index', compact('stats'));
    }

    public function createCase(Request $request)
    {
        // Create discipline case logic here
        return redirect()->back()->with('success', 'Discipline case created');
    }

    public function updateCase($id, Request $request)
    {
        // Update discipline case logic here
        return redirect()->back()->with('success', 'Discipline case updated');
    }

    public function scheduleHearing($id, Request $request)
    {
        // Schedule hearing logic here
        return redirect()->back()->with('success', 'Hearing scheduled');
    }

    public function closeCase($id, Request $request)
    {
        // Close discipline case logic here
        return redirect()->back()->with('success', 'Discipline case closed');
    }
}
