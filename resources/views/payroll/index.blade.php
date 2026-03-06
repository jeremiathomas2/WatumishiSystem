@extends('layouts.app')

@section('title', 'Advanced Payroll Management')
@section('subtitle', 'Comprehensive payroll system with analytics and automation')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Advanced Payroll Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <!-- Total Payroll -->
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Total Payroll</p>
                    <p class="text-4xl font-bold text-white mt-2">TZS {{ number_format($stats['total_payroll'] ?? 0) }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-money-bill-wave mr-1"></i>
                        <span>{{ $stats['payroll_growth'] ?? 12 }}% from last month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Processed Count -->
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Processed</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['processed_count'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-check-circle mr-1"></i>
                        <span>{{ $stats['processing_rate'] ?? 98 }}% success rate</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Pending Count -->
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Pending</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['pending_count'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-clock mr-1"></i>
                        <span>Requires action</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Tax Deductions -->
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Tax Deductions</p>
                    <p class="text-4xl font-bold text-white mt-2">TZS {{ number_format($stats['total_tax'] ?? 0) }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-receipt mr-1"></i>
                        <span>{{ $stats['tax_rate'] ?? 18 }}% average</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-receipt text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Net Payroll -->
        <div class="stat-card p-6 rounded-xl border border-orange-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-300 text-sm font-semibold uppercase tracking-wider">Net Payroll</p>
                    <p class="text-4xl font-bold text-white mt-2">TZS {{ number_format($stats['net_payroll'] ?? 0) }}</p>
                    <div class="flex items-center mt-3 text-orange-400 text-sm">
                        <i class="fas fa-hand-holding-usd mr-1"></i>
                        <span>After deductions</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-orange-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-hand-holding-usd text-orange-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Controls -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Payroll Operations</h3>
            <div class="flex items-center space-x-4">
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none" id="period-filter">
                    <option value="current">Current Month</option>
                    <option value="last">Last Month</option>
                    <option value="quarter">This Quarter</option>
                    <option value="year">This Year</option>
                    <option value="custom">Custom Range</option>
                </select>
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none" id="department-filter">
                    <option value="all">All Departments</option>
                    <option value="it">IT Department</option>
                    <option value="hr">HR Department</option>
                    <option value="finance">Finance Department</option>
                    <option value="marketing">Marketing Department</option>
                    <option value="sales">Sales Department</option>
                </select>
                <button onclick="showPayrollWizard()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                    <i class="fas fa-magic mr-2"></i>Payroll Wizard
                </button>
                <button onclick="batchProcessPayroll()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-robot mr-2"></i>Batch Process
                </button>
                <button onclick="exportAdvancedPayroll()" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200">
                    <i class="fas fa-download mr-2"></i>Advanced Export
                </button>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <button onclick="generatePayslips()" class="glass-effect p-4 rounded-lg text-center hover:bg-white hover:bg-opacity-10 transition-all">
                <i class="fas fa-file-invoice-dollar text-2xl text-green-400 mb-2"></i>
                <p class="text-white font-medium">Generate All Payslips</p>
                <p class="text-blue-300 text-sm">Create payslips for all employees</p>
            </button>
            <button onclick="runPayrollAudit()" class="glass-effect p-4 rounded-lg text-center hover:bg-white hover:bg-opacity-10 transition-all">
                <i class="fas fa-shield-alt text-2xl text-purple-400 mb-2"></i>
                <p class="text-white font-medium">Run Payroll Audit</p>
                <p class="text-blue-300 text-sm">Verify payroll calculations</p>
            </button>
            <button onclick="schedulePayroll()" class="glass-effect p-4 rounded-lg text-center hover:bg-white hover:bg-opacity-10 transition-all">
                <i class="fas fa-calendar-alt text-2xl text-orange-400 mb-2"></i>
                <p class="text-white font-medium">Schedule Payroll</p>
                <p class="text-blue-300 text-sm">Automate future payroll runs</p>
            </button>
        </div>
    </div>

    <!-- Advanced Payroll Table -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Payroll Records</h3>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search employees..." class="glass-input pl-10 pr-4 py-2 rounded-lg text-white outline-none w-64" id="payroll-search">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <button onclick="toggleAdvancedView()" class="glass-effect px-4 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-10 transition-all">
                    <i class="fas fa-cog mr-2"></i>Advanced View
                </button>
                <button onclick="refreshPayrollData()" class="glass-effect px-4 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-10 transition-all">
                    <i class="fas fa-sync-alt mr-2"></i>Refresh
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">
                            <input type="checkbox" class="mr-2" onchange="toggleSelectAll(this)">
                        </th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Employee</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Department</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Period</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Basic Salary</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Allowances</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Deductions</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Net Salary</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Status</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Payment Date</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="payroll-table-body">
                    <!-- Advanced payroll data will be loaded here -->
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
                                    <p class="text-blue-300 text-xs">EMP0001 • IT Department</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-blue-300">December 2023</td>
                        <td class="py-3 px-4 text-white">TZS 2,500,000</td>
                        <td class="py-3 px-4 text-green-400">+TZS 500,000</td>
                        <td class="py-3 px-4 text-red-400">-TZS 450,000</td>
                        <td class="py-3 px-4 text-white font-bold">TZS 2,550,000</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                Processed
                            </span>
                        </td>
                        <td class="py-3 px-4 text-blue-300">2023-12-25</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button onclick="viewPayrollDetails(1)" class="text-blue-400 hover:text-blue-300 transition-colors" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editPayrollRecord(1)" class="text-yellow-400 hover:text-yellow-300 transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="downloadPayslip(1)" class="text-green-400 hover:text-green-300 transition-colors" title="Download Payslip">
                                    <i class="fas fa-file-invoice"></i>
                                </button>
                                <button onclick="approvePayroll(1)" class="text-purple-400 hover:text-purple-300 transition-colors" title="Approve">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                <button onclick="deletePayrollRecord(1)" class="text-red-400 hover:text-red-300 transition-colors" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6">
            <div class="flex items-center space-x-2">
                <button class="glass-effect px-3 py-1 rounded text-gray-400 hover:text-white transition-colors">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <span class="text-blue-300">Page 1 of 10</span>
                <button class="glass-effect px-3 py-1 rounded text-gray-400 hover:text-white transition-colors">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-blue-300">Show</span>
                <select class="glass-input px-3 py-1 rounded text-white outline-none">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="text-blue-300">entries</span>
            </div>
        </div>
    </div>
</div>

<!-- Advanced Payroll Modals -->
<div id="payroll-wizard-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="glass-card p-6 rounded-xl w-full max-w-2xl mx-4">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Payroll Wizard</h3>
            <button onclick="closePayrollWizard()" class="text-gray-400 hover:text-white transition-colors">
                <i class="fas fa-times text-xl"></i>
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
