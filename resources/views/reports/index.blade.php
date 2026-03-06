@extends('layouts.app')

@section('title', 'Reports')
@section('subtitle', 'Generate and view various reports')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Reports Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Reports -->
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Total Reports</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['total_reports'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-file-alt mr-1"></i>
                        <span>All reports</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-alt text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Reports This Month -->
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">This Month</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['reports_this_month'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-calendar mr-1"></i>
                        <span>Generated reports</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Financial Reports -->
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Financial</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['financial_reports'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-dollar-sign mr-1"></i>
                        <span>Payroll reports</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Attendance Reports -->
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Attendance</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['attendance_reports'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-clock mr-1"></i>
                        <span>Time tracking</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Categories -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Financial Reports -->
        <div class="glass-card p-6 rounded-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Financial Reports</h3>
                <a href="{{ route('reports.financial') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                    View all <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center p-4 bg-gray-800 bg-opacity-50 rounded-lg hover:bg-opacity-70 transition-all cursor-pointer">
                    <div class="w-12 h-12 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-money-bill text-green-400 text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-white font-medium">Payroll Summary</h4>
                        <p class="text-gray-400 text-sm">Monthly payroll breakdown</p>
                    </div>
                    <i class="fas fa-download text-blue-400"></i>
                </div>
                <div class="flex items-center p-4 bg-gray-800 bg-opacity-50 rounded-lg hover:bg-opacity-70 transition-all cursor-pointer">
                    <div class="w-12 h-12 bg-blue-500 bg-opacity-20 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-chart-pie text-blue-400 text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-white font-medium">Expense Analysis</h4>
                        <p class="text-gray-400 text-sm">Department-wise expenses</p>
                    </div>
                    <i class="fas fa-download text-blue-400"></i>
                </div>
            </div>
        </div>

        <!-- Attendance Reports -->
        <div class="glass-card p-6 rounded-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Attendance Reports</h3>
                <a href="{{ route('reports.attendance') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                    View all <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center p-4 bg-gray-800 bg-opacity-50 rounded-lg hover:bg-opacity-70 transition-all cursor-pointer">
                    <div class="w-12 h-12 bg-purple-500 bg-opacity-20 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-check text-purple-400 text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-white font-medium">Monthly Attendance</h4>
                        <p class="text-gray-400 text-sm">Employee attendance summary</p>
                    </div>
                    <i class="fas fa-download text-blue-400"></i>
                </div>
                <div class="flex items-center p-4 bg-gray-800 bg-opacity-50 rounded-lg hover:bg-opacity-70 transition-all cursor-pointer">
                    <div class="w-12 h-12 bg-yellow-500 bg-opacity-20 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-user-clock text-yellow-400 text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-white font-medium">Time Tracking</h4>
                        <p class="text-gray-400 text-sm">Hours worked analysis</p>
                    </div>
                    <i class="fas fa-download text-blue-400"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
