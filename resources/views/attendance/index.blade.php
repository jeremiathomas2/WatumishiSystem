@extends('layouts.app')

@section('title', 'Attendance Management')
@section('subtitle', 'Track employee attendance and time management')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Attendance Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Present Today -->
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Present Today</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['present_today'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-check-circle mr-1"></i>
                        <span>On time</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Late Today -->
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Late Today</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['late_today'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-clock mr-1"></i>
                        <span>Delayed arrival</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Absent Today -->
        <div class="stat-card p-6 rounded-xl border border-red-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-300 text-sm font-semibold uppercase tracking-wider">Absent Today</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['absent_today'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-red-400 text-sm">
                        <i class="fas fa-times-circle mr-1"></i>
                        <span>Not present</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-red-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-times-circle text-red-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- On Leave Today -->
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">On Leave Today</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['on_leave_today'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        <span>Approved leave</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Management Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Attendance Table -->
        <div class="lg:col-span-2 glass-card p-6 rounded-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Today's Attendance</h3>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Search attendance..." class="glass-input px-4 py-2 pr-10 rounded-lg text-white placeholder-blue-200 outline-none w-64" onkeyup="searchAttendance(this.value)">
                        <i class="fas fa-search absolute right-3 top-3 text-blue-300"></i>
                    </div>
                    <input type="date" value="{{ now()->format('Y-m-d') }}" class="glass-input px-4 py-2 rounded-lg text-white outline-none">
                    <select class="glass-input px-4 py-2 rounded-lg text-white outline-none" onchange="filterByStatus(this.value)">
                        <option value="all">All Status</option>
                        <option value="present">Present</option>
                        <option value="late">Late</option>
                        <option value="absent">Absent</option>
                        <option value="leave">On Leave</option>
                    </select>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="overflow-x-auto">
                <table class="w-full glass-card">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="text-left p-4 text-blue-300 font-semibold uppercase tracking-wider">Employee</th>
                            <th class="text-left p-4 text-blue-300 font-semibold uppercase tracking-wider">Check In</th>
                            <th class="text-left p-4 text-blue-300 font-semibold uppercase tracking-wider">Check Out</th>
                            <th class="text-left p-4 text-blue-300 font-semibold uppercase tracking-wider">Status</th>
                            <th class="text-left p-4 text-blue-300 font-semibold uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                        <tr class="border-b border-gray-700 hover:bg-white hover:bg-opacity-5 transition-colors duration-200">
                            <td class="p-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium">{{ $attendance['employee_name'] }}</p>
                                        <p class="text-blue-300 text-xs">{{ $attendance['employee_id'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="text-white font-medium">{{ $attendance['check_in'] ?? '--:--' }}</span>
                            </td>
                            <td class="p-4">
                                <span class="text-white font-medium">{{ $attendance['check_out'] ?? '--:--' }}</span>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-xs rounded-full 
                                    @if($attendance['status'] == 'present') bg-green-600 
                                    @elseif($attendance['status'] == 'late') bg-yellow-600 
                                    @elseif($attendance['status'] == 'absent') bg-red-600 
                                    @else bg-blue-600 
                                    @endif">
                                    {{ ucfirst($attendance['status']) }}
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center space-x-2">
                                    <button class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-green-400 hover:text-green-300 transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Loading attendance data...
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions & Stats -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="glass-card p-6 rounded-xl">
                <h3 class="text-xl font-semibold text-white mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <button onclick="markAttendance()" class="bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-user-check mr-2"></i>
                        Mark All Present
                    </button>
                    <button class="bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-download mr-2"></i>
                        Export Attendance
                    </button>
                </div>
            </div>

            <!-- Attendance Summary -->
            <div class="glass-card p-6 rounded-xl">
                <h3 class="text-xl font-semibold text-white mb-4">Weekly Summary</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-green-400 text-sm">Present Rate</span>
                        <span class="text-white font-semibold">{{ $stats['weekly_present_rate'] ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-green-500 h-full rounded-full" style="width: {{ $stats['weekly_present_rate'] ?? 0 }}%"></div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-yellow-400 text-sm">Late Rate</span>
                        <span class="text-white font-semibold">{{ $stats['weekly_late_rate'] ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-yellow-500 h-full rounded-full" style="width: {{ $stats['weekly_late_rate'] ?? 0 }}%"></div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-red-400 text-sm">Absent Rate</span>
                        <span class="text-white font-semibold">{{ $stats['weekly_absent_rate'] ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-red-500 h-full rounded-full" style="width: {{ $stats['weekly_absent_rate'] ?? 0 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Department Overview -->
            <div class="glass-card p-6 rounded-xl">
                <h3 class="text-xl font-semibold text-white mb-4">Department Overview</h3>
                <div class="space-y-3">
                    @foreach ($departmentStats as $dept)
                    <div class="flex items-center justify-between p-3 bg-gray-700 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">{{ $dept['name'] }}</p>
                            <p class="text-blue-300 text-xs">{{ $dept['present'] }}/{{ $dept['total'] }} present</p>
                        </div>
                        <div class="text-right">
                            <p class="text-green-400 font-semibold">{{ $dept['attendance_rate'] }}%</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function searchAttendance(query) {
    // Search functionality
    console.log('Searching for:', query);
}

function filterByStatus(status) {
    // Filter functionality
    console.log('Filtering by status:', status);
}

function markAttendance() {
    // Mark all present functionality
    console.log('Marking all present');
}
</script>
@endsection
