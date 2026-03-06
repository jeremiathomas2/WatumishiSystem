@extends('layouts.app')

@section('title', 'Payroll Management')
@section('subtitle', 'Manage employee payroll and compensation')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Payroll Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Total Payroll</p>
                    <p class="text-4xl font-bold text-white mt-2">TZS {{ number_format($stats['total_payroll'] ?? 0) }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-money-bill-wave mr-1"></i>
                        <span>Monthly</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Processed</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['processed_count'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-check-circle mr-1"></i>
                        <span>This month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Pending</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['pending_count'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-clock mr-1"></i>
                        <span>Awaiting approval</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Deductions</p>
                    <p class="text-4xl font-bold text-white mt-2">TZS {{ number_format($stats['total_deductions'] ?? 0) }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-minus-circle mr-1"></i>
                        <span>Total deductions</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-minus-circle text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Payroll Processing -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Payroll Processing</h3>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search payroll..." class="glass-input px-4 py-2 pr-10 rounded-lg text-white placeholder-blue-200 outline-none w-64" onkeyup="searchPayroll(this.value)">
                    <i class="fas fa-search absolute right-3 top-3 text-blue-300"></i>
                </div>
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none">
                    <option value="december">December 2024</option>
                    <option value="november">November 2024</option>
                    <option value="october">October 2024</option>
                </select>
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none" onchange="filterByStatus(this.value)">
                    <option value="">All Status</option>
                    <option value="processed">Processed</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Failed</option>
                </select>
                <button onclick="processPayroll()" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-calculator mr-2"></i>Process Payroll
                </button>
                <button onclick="importPayroll()" class="bg-purple-500 hover:bg-purple-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-upload mr-2"></i>Import
                </button>
                <button onclick="exportPayroll()" class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="glass-effect p-4 rounded-lg text-center">
                <div class="w-12 h-12 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-users text-green-400 text-xl"></i>
                </div>
                <p class="text-2xl font-bold text-white">{{ $stats['total_employees'] ?? 156 }}</p>
                <p class="text-blue-300 text-sm">Total Employees</p>
            </div>
            
            <div class="glass-effect p-4 rounded-lg text-center">
                <div class="w-12 h-12 bg-blue-500 bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-money-check text-blue-400 text-xl"></i>
                </div>
                <p class="text-2xl font-bold text-white">{{ $stats['avg_salary'] ?? 2500000 }}</p>
                <p class="text-blue-300 text-sm">Avg Salary</p>
            </div>
            
            <div class="glass-effect p-4 rounded-lg text-center">
                <div class="w-12 h-12 bg-purple-500 bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-percentage text-purple-400 text-xl"></i>
                </div>
                <p class="text-2xl font-bold text-white">{{ $stats['tax_rate'] ?? 18 }}%</p>
                <p class="text-blue-300 text-sm">Tax Rate</p>
            </div>
        </div>
        
        <!-- Payroll Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">
                            <input type="checkbox" class="mr-2" onchange="toggleSelectAll(this)">
                        </th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Employee</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Basic Salary</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Allowances</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Deductions</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Net Salary</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Status</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition-colors">
                        <td class="py-3 px-4">
                            <input type="checkbox" class="payroll-checkbox" data-id="1">
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">JS</span>
                                </div>
                                <div>
                                    <p class="text-white font-medium">John Smith</p>
                                    <p class="text-blue-300 text-xs">EMP0001</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-white">TZS 2,500,000</td>
                        <td class="py-3 px-4 text-white">TZS 500,000</td>
                        <td class="py-3 px-4 text-white">TZS 450,000</td>
                        <td class="py-3 px-4 text-white font-bold">TZS 2,550,000</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                Processed
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button onclick="viewPayrollRecord(1)" class="text-blue-400 hover:text-blue-300 transition-colors" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editPayrollRecord(1)" class="text-yellow-400 hover:text-yellow-300 transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="downloadPayslip(1)" class="text-green-400 hover:text-green-300 transition-colors" title="Download Payslip">
                                    <i class="fas fa-file-invoice"></i>
                                </button>
                                <button onclick="deletePayrollRecord(1)" class="text-red-400 hover:text-red-300 transition-colors" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition-colors">
                        <td class="py-3 px-4">
                            <input type="checkbox" class="payroll-checkbox" data-id="2">
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">SJ</span>
                                </div>
                                <div>
                                    <p class="text-white font-medium">Sarah Johnson</p>
                                    <p class="text-blue-300 text-xs">EMP0002</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-white">TZS 3,000,000</td>
                        <td class="py-3 px-4 text-white">TZS 600,000</td>
                        <td class="py-3 px-4 text-white">TZS 540,000</td>
                        <td class="py-3 px-4 text-white font-bold">TZS 3,060,000</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-500 bg-opacity-20 text-yellow-400">
                                Pending
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button onclick="viewPayrollRecord(2)" class="text-blue-400 hover:text-blue-300 transition-colors" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editPayrollRecord(2)" class="text-yellow-400 hover:text-yellow-300 transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="downloadPayslip(2)" class="text-green-400 hover:text-green-300 transition-colors" title="Download Payslip">
                                    <i class="fas fa-file-invoice"></i>
                                </button>
                                <button onclick="deletePayrollRecord(2)" class="text-red-400 hover:text-red-300 transition-colors" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Bulk Actions -->
        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-700">
            <div class="flex items-center space-x-4">
                <button onclick="bulkProcessPayroll()" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-calculator mr-2"></i>Process Selected
                </button>
                <button onclick="bulkExportPayroll()" class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                    <i class="fas fa-download mr-2"></i>Export Selected
                </button>
                <button onclick="bulkDownloadPayslips()" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-file-invoice mr-2"></i>Download Payslips
                </button>
                <button onclick="bulkDeletePayroll()" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-trash mr-2"></i>Delete Selected
                </button>
            </div>
            <div class="text-blue-300 text-sm">
                <span id="selected-count">0</span> records selected
            </div>
        </div>
    </div>
                                Processed
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300" title="View Payslip">
                                    <i class="fas fa-file-invoice"></i>
                                </button>
                                <button class="text-green-400 hover:text-green-300" title="Download">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">SJ</span>
                                </div>
                                <div>
                                    <p class="text-white font-medium">Sarah Johnson</p>
                                    <p class="text-blue-300 text-xs">EMP0002</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-white">TZS 2,000,000</td>
                        <td class="py-3 px-4 text-white">TZS 400,000</td>
                        <td class="py-3 px-4 text-white">TZS 360,000</td>
                        <td class="py-3 px-4 text-white font-bold">TZS 2,040,000</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                Processed
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300" title="View Payslip">
                                    <i class="fas fa-file-invoice"></i>
                                </button>
                                <button class="text-green-400 hover:text-green-300" title="Download">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-green-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">MB</span>
                                </div>
                                <div>
                                    <p class="text-white font-medium">Michael Brown</p>
                                    <p class="text-blue-300 text-xs">EMP0003</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-white">TZS 1,800,000</td>
                        <td class="py-3 px-4 text-white">TZS 350,000</td>
                        <td class="py-3 px-4 text-white">TZS 324,000</td>
                        <td class="py-3 px-4 text-white font-bold">TZS 1,826,000</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-500 bg-opacity-20 text-yellow-400">
                                Pending
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300" title="View Payslip">
                                    <i class="fas fa-file-invoice"></i>
                                </button>
                                <button class="text-yellow-400 hover:text-yellow-300" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Payroll Summary -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-6">Payroll Summary</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-blue-300">Gross Pay</span>
                    <span class="text-white font-bold">TZS {{ number_format($stats['gross_pay'] ?? 390000000) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-blue-300">Total Deductions</span>
                    <span class="text-white font-bold">TZS {{ number_format($stats['total_deductions'] ?? 70200000) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-blue-300">Net Pay</span>
                    <span class="text-white font-bold text-green-400">TZS {{ number_format($stats['net_pay'] ?? 319800000) }}</span>
                </div>
                <div class="border-t border-gray-700 pt-4">
                    <div class="flex items-center justify-between">
                        <span class="text-blue-300">PAYE Tax</span>
                        <span class="text-white">TZS {{ number_format($stats['paye_tax'] ?? 58500000) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-blue-300">NSSF</span>
                        <span class="text-white">TZS {{ number_format($stats['nssf'] ?? 7800000) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-blue-300">Other Deductions</span>
                        <span class="text-white">TZS {{ number_format($stats['other_deductions'] ?? 3900000) }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-6">Department Payroll Breakdown</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-blue-300">IT Department</span>
                    </div>
                    <span class="text-white font-medium">TZS 62,500,000</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-blue-300">HR Department</span>
                    </div>
                    <span class="text-white font-medium">TZS 24,000,000</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                        <span class="text-blue-300">Finance</span>
                    </div>
                    <span class="text-white font-medium">TZS 63,000,000</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        <span class="text-blue-300">Operations</span>
                    </div>
                    <span class="text-white font-medium">TZS 144,000,000</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-pink-500 rounded-full"></div>
                        <span class="text-blue-300">Marketing</span>
                    </div>
                    <span class="text-white font-medium">TZS 45,000,000</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                        <span class="text-blue-300">Sales</span>
                    </div>
                    <span class="text-white font-medium">TZS 51,300,000</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
