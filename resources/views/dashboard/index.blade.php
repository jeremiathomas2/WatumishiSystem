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
            
            <!-- Chart Canvas -->
            <div class="h-64">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <button onclick="quickAddEmployee()" class="w-full glass-card p-4 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-user-plus text-blue-400"></i>
                        <span class="text-white">Add New Employee</span>
                    </div>
                </button>
                <button onclick="quickApproveLeave()" class="w-full glass-card p-4 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-calendar-plus text-green-400"></i>
                        <span class="text-white">Approve Leave Request</span>
                    </div>
                </button>
                <button onclick="quickProcessPayroll()" class="w-full glass-card p-4 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-file-invoice text-yellow-400"></i>
                        <span class="text-white">Process Payroll</span>
                    </div>
                </button>
                <button onclick="quickGenerateReports()" class="w-full glass-card p-4 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-chart-bar text-purple-400"></i>
                        <span class="text-white">Generate Reports</span>
                    </div>
                </button>
                <button onclick="quickBackupSystem()" class="w-full glass-card p-4 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-database text-red-400"></i>
                        <span class="text-white">Backup System</span>
                    </div>
                </button>
                <button onclick="quickSystemSettings()" class="w-full glass-card p-4 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-cog text-gray-400"></i>
                        <span class="text-white">System Settings</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
    
    <!-- System Status and Alerts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- System Health -->
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">System Health</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Database</span>
                    <span class="px-2 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">Healthy</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Storage</span>
                    <span class="text-gray-300 text-sm">68% Used</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Memory</span>
                    <span class="text-gray-300 text-sm">42% Used</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">Last Backup</span>
                    <span class="text-gray-300 text-sm">2 hours ago</span>
                </div>
            </div>
        </div>
        
        <!-- Recent Alerts -->
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Recent Alerts</h3>
            <div class="space-y-3">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-exclamation-triangle text-yellow-400 mt-1"></i>
                    <div>
                        <p class="text-white text-sm">3 pending leave requests</p>
                        <p class="text-gray-400 text-xs">10 minutes ago</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-info-circle text-blue-400 mt-1"></i>
                    <div>
                        <p class="text-white text-sm">System backup completed</p>
                        <p class="text-gray-400 text-xs">2 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-user-plus text-green-400 mt-1"></i>
                    <div>
                        <p class="text-white text-sm">New employee registered</p>
                        <p class="text-gray-400 text-xs">5 hours ago</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Upcoming Events -->
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Upcoming Events</h3>
            <div class="space-y-3">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-calendar text-purple-400 mt-1"></i>
                    <div>
                        <p class="text-white text-sm">Payroll Processing</p>
                        <p class="text-gray-400 text-xs">Tomorrow, 9:00 AM</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-users text-blue-400 mt-1"></i>
                    <div>
                        <p class="text-white text-sm">Team Meeting</p>
                        <p class="text-gray-400 text-xs">Friday, 2:00 PM</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-graduation-cap text-green-400 mt-1"></i>
                    <div>
                        <p class="text-white text-sm">Training Session</p>
                        <p class="text-gray-400 text-xs">Next Monday, 10:00 AM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Leave Requests -->
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Recent Leave Requests</h3>
            <div class="space-y-3">
                @forelse ($recentActivities['recent_leave_requests'] as $leaveRequest)
                    <div class="flex items-center justify-between p-3 glass-card rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-blue-400 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-white font-medium">{{ $leaveRequest->employee->full_name }}</p>
                                <p class="text-gray-400 text-xs">{{ $leaveRequest->leave_type }} - {{ $leaveRequest->days_requested }} days</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full 
                            @if ($leaveRequest->status == 'pending') bg-yellow-500 bg-opacity-20 text-yellow-400
                            @elseif ($leaveRequest->status == 'approved') bg-green-500 bg-opacity-20 text-green-400
                            @else bg-red-500 bg-opacity-20 text-red-400 @endif">
                            {{ ucfirst($leaveRequest->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">No recent leave requests</p>
                @endforelse
            </div>
        </div>
        
        <!-- Recent Discipline Cases -->
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Recent Discipline Cases</h3>
            <div class="space-y-3">
                @forelse ($recentActivities['recent_discipline_cases'] as $case)
                    <div class="flex items-center justify-between p-3 glass-card rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-red-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-red-400 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-white font-medium">{{ $case->employee->full_name }}</p>
                                <p class="text-gray-400 text-xs">{{ $case->misconduct_type }} misconduct</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full 
                            @if ($case->risk_level == 'high') bg-red-500 bg-opacity-20 text-red-400
                            @elseif ($case->risk_level == 'medium') bg-yellow-500 bg-opacity-20 text-yellow-400
                            @else bg-green-500 bg-opacity-20 text-green-400 @endif">
                            {{ ucfirst($case->risk_level) }} Risk
                        </span>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">No recent discipline cases</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Dashboard Quick Actions
    function quickAddEmployee() {
        showNotification('Opening employee registration form...', 'info');
        setTimeout(() => {
            window.location.href = '/employee/create';
        }, 1000);
    }

    function quickApproveLeave() {
        showNotification('Loading pending leave requests...', 'info');
        setTimeout(() => {
            window.location.href = '/leave/pending';
        }, 1000);
    }

    function quickProcessPayroll() {
        showNotification('Opening payroll processing...', 'info');
        setTimeout(() => {
            window.location.href = '/payroll/process';
        }, 1000);
    }

    function quickGenerateReports() {
        showNotification('Opening report generator...', 'info');
        setTimeout(() => {
            window.location.href = '/reports/generate';
        }, 1000);
    }

    function quickBackupSystem() {
        confirmAction('Create a system backup now?', () => {
            showNotification('Creating system backup...', 'info');
            createBackup('full').then(() => {
                showNotification('System backup completed successfully!', 'success');
                updateSystemStatus();
            });
        });
    }

    function quickSystemSettings() {
        showNotification('Opening system settings...', 'info');
        setTimeout(() => {
            window.location.href = '/settings';
        }, 1000);
    }

    // Real-time updates
    function updateSystemStatus() {
        // Simulate real-time system updates
        fetch('/api/system/status')
            .then(response => response.json())
            .then(data => {
                // Update system health indicators
                updateHealthIndicators(data);
            })
            .catch(error => {
                console.log('System status update failed:', error);
            });
    }

    function updateHealthIndicators(data) {
        // Update database status
        const dbStatus = document.querySelector('.system-db-status');
        if (dbStatus) {
            dbStatus.className = data.database_healthy ? 
                'px-2 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400' : 
                'px-2 py-1 text-xs rounded-full bg-red-500 bg-opacity-20 text-red-400';
            dbStatus.textContent = data.database_healthy ? 'Healthy' : 'Error';
        }
    }

    // Attendance Chart
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Present', 'Absent', 'Late', 'On Leave'],
            datasets: [{
                data: [
                    {{ $attendanceSummary['present'] }},
                    {{ $attendanceSummary['absent'] }},
                    {{ $attendanceSummary['late'] }},
                    {{ $attendanceSummary['on_leave'] }}
                ],
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(59, 130, 246, 0.8)'
                ],
                borderColor: [
                    'rgba(34, 197, 94, 1)',
                    'rgba(239, 68, 68, 1)',
                    'rgba(245, 158, 11, 1)',
                    'rgba(59, 130, 246, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#fff',
                        padding: 20
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
    
    // Add interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stat cards on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        });
        
        document.querySelectorAll('.stat-card').forEach(card => {
            observer.observe(card);
        });

        // Auto-refresh dashboard data every 30 seconds
        setInterval(() => {
            updateSystemStatus();
        }, 30000);

        // Handle real-time alerts
        setupRealTimeAlerts();
    });

    function setupRealTimeAlerts() {
        // Simulate WebSocket connection for real-time alerts
        // In production, this would connect to actual WebSocket server
        console.log('Real-time alerts monitoring active');
    }

    // Export dashboard data
    function exportDashboardData() {
        const dashboardData = {
            stats: {
                total_employees: {{ $stats['total_employees'] }},
                active_employees: {{ $stats['active_employees'] }},
                pending_leave: {{ $stats['pending_leave_requests'] }},
                open_cases: {{ $stats['open_discipline_cases'] }}
            },
            attendance: {
                present: {{ $attendanceSummary['present'] }},
                absent: {{ $attendanceSummary['absent'] }},
                late: {{ $attendanceSummary['late'] }},
                on_leave: {{ $attendanceSummary['on_leave'] }}
            },
            timestamp: new Date().toISOString()
        };

        exportData(dashboardData, 'dashboard_export', 'json');
    }

    // Print dashboard
    function printDashboard() {
        window.print();
        showNotification('Preparing dashboard for printing...', 'info');
    }
</script>
@endpush
