<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        // Mock data for demonstration
        $stats = [
            'total_payroll' => 390000000,
            'processed_count' => 142,
            'pending_count' => 14,
            'total_deductions' => 70200000,
            'gross_pay' => 390000000,
            'net_pay' => 319800000,
            'paye_tax' => 58500000,
            'nssf' => 7800000,
            'other_deductions' => 3900000
        ];

        return view('payroll.index', compact('stats'));
    }

    public function processPayroll(Request $request)
    {
        // Process payroll logic here
        return redirect()->back()->with('success', 'Payroll processed successfully');
    }

    public function generatePayslip($employeeId, $month, $year)
    {
        // Generate payslip logic here
        return response()->download("payslip_{$employeeId}_{$month}_{$year}.pdf");
    }

    public function exportPayrollReport(Request $request)
    {
        // Export payroll report logic here
        return response()->download('payroll-report.pdf');
    }
}
