@extends('layouts.app')

@section('title', 'Attendance Reports')
@section('subtitle', 'Employee attendance and time tracking reports')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Attendance Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Records -->
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Total Records</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['total_attendance_records'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-database mr-1"></i>
                        <span>All entries</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-database text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Attendance Rate -->
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Attendance Rate</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['attendance_rate'] ?? 0 }}%</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-chart-line mr-1"></i>
                        <span>Monthly average</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-line text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Absent Days -->
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Absent Days</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['absent_days'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-calendar-times mr-1"></i>
                        <span>This month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-times text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Late Arrivals -->
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Late Arrivals</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['late_arrivals'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-clock mr-1"></i>
                        <span>This month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Reports Table -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Attendance Reports</h3>
            <div class="flex items-center space-x-4">
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none">
                    <option value="current">Current Month</option>
                    <option value="quarter">This Quarter</option>
                    <option value="year">This Year</option>
                </select>
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                    <i class="fas fa-download mr-2"></i>
                    Export All
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="p-4 text-left text-blue-300">Employee</th>
                        <th class="p-4 text-left text-blue-300">Period</th>
                        <th class="p-4 text-left text-blue-300">Days Present</th>
                        <th class="p-4 text-left text-blue-300">Days Absent</th>
                        <th class="p-4 text-left text-blue-300">Late Arrivals</th>
                        <th class="p-4 text-left text-blue-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr class="border-b border-gray-800 hover:bg-gray-800 hover:bg-opacity-50 transition-colors">
                        <td class="p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-blue-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-user text-blue-400 text-sm"></i>
                                </div>
                                <div>
                                    <span class="text-white font-medium">{{ $report['employee'] ?? 'John Doe' }}</span>
                                    <p class="text-gray-400 text-xs">{{ $report['department'] ?? 'IT' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="text-white">{{ $report['period'] ?? 'December 2023' }}</span>
                        </td>
                        <td class="p-4">
                            <span class="text-green-400 font-medium">{{ $report['days_present'] ?? 22 }}</span>
                        </td>
                        <td class="p-4">
                            <span class="text-red-400 font-medium">{{ $report['days_absent'] ?? 2 }}</span>
                        </td>
                        <td class="p-4">
                            <span class="text-yellow-400 font-medium">{{ $report['late_arrivals'] ?? 1 }}</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-400 hover:text-green-300 transition-colors duration-200">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-400">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Loading attendance reports...
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
