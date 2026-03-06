@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'System Overview & Analytics')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Employees -->
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Total Employees</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['total_employees'] }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>12% from last month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Active Employees -->
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Active Employees</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['active_employees'] }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>8% from last month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-check text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Pending Leave Requests -->
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Pending Leave</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['pending_leave_requests'] }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-clock mr-1"></i>
                        <span>Requires approval</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Open Discipline Cases -->
        <div class="stat-card p-6 rounded-xl border border-red-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-300 text-sm font-semibold uppercase tracking-wider">Open Cases</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['open_discipline_cases'] }}</p>
                    <div class="flex items-center mt-3 text-red-400 text-sm">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        <span>Requires attention</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-red-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-gavel text-red-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts and Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Attendance Chart -->
        <div class="lg:col-span-2 glass-card p-6 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Today's Attendance Overview</h3>
            <div class="grid grid-cols-4 gap-4 mb-6">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-green-500 bg-opacity-20 rounded-full flex items-center justify-center mb-2">
                        <span class="text-2xl font-bold text-green-400">{{ $attendanceSummary['present'] }}</span>
                    </div>
                    <p class="text-gray-400 text-sm">Present</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-red-500 bg-opacity-20 rounded-full flex items-center justify-center mb-2">
                        <span class="text-2xl font-bold text-red-400">{{ $attendanceSummary['absent'] }}</span>
                    </div>
                    <p class="text-gray-400 text-sm">Absent</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-yellow-500 bg-opacity-20 rounded-full flex items-center justify-center mb-2">
                        <span class="text-2xl font-bold text-yellow-400">{{ $attendanceSummary['late'] }}</span>
                    </div>
                    <p class="text-gray-400 text-sm">Late</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-blue-500 bg-opacity-20 rounded-full flex items-center justify-center mb-2">
                        <span class="text-2xl font-bold text-blue-400">{{ $attendanceSummary['on_leave'] }}</span>
                    </div>
                    <p class="text-gray-400 text-sm">On Leave</p>
                </div>
            </div>
            <div class="h-64 bg-gray-800 bg-opacity-50 rounded-lg flex items-center justify-center">
                <canvas id="attendanceChart" class="w-full h-full"></canvas>
            </div>
        </div>
        
        <!-- Recent Activities -->
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Recent Activities</h3>
            <div class="space-y-3" id="recentActivities">
                <!-- Activities will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
// Load recent activities
function loadRecentActivities() {
    const activities = [
        { icon: 'fa-user-plus', color: 'text-green-400', text: 'New employee registered', time: '2 minutes ago' },
        { icon: 'fa-clock', color: 'text-blue-400', text: 'Attendance data synced', time: '15 minutes ago' },
        { icon: 'fa-exclamation-triangle', color: 'text-yellow-400', text: 'Device ATT-001 offline', time: '1 hour ago' },
        { icon: 'fa-calendar-check', color: 'text-purple-400', text: 'Leave request approved', time: '2 hours ago' },
        { icon: 'fa-file-export', color: 'text-orange-400', text: 'Monthly report generated', time: '3 hours ago' }
    ];
    
    const container = document.getElementById('recentActivities');
    container.innerHTML = activities.map(activity => `
        <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-white hover:bg-opacity-5 transition-all duration-200">
            <div class="w-8 h-8 rounded-full bg-gray-700 bg-opacity-50 flex items-center justify-center flex-shrink-0">
                <i class="fas ${activity.icon} ${activity.color} text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-white text-sm font-medium">${activity.text}</p>
                <p class="text-gray-400 text-xs">${activity.time}</p>
            </div>
        </div>
    `).join('');
}

// Initialize attendance chart
function initAttendanceChart() {
    const ctx = document.getElementById('attendanceChart');
    if (!ctx) return;
    
    // Simple chart implementation
    ctx.style.background = 'linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%)';
    ctx.innerHTML = `
        <div class="flex items-center justify-center h-full text-gray-400">
            <div class="text-center">
                <i class="fas fa-chart-line text-4xl mb-2"></i>
                <p class="text-sm">Attendance Chart</p>
                <p class="text-xs">Real-time data visualization</p>
            </div>
        </div>
    `;
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    loadRecentActivities();
    initAttendanceChart();
});
</script>
@endsection
