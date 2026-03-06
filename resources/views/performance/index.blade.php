@extends('layouts.app')

@section('title', 'Performance Management')
@section('subtitle', 'Employee performance evaluation and management')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Performance Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Average Performance -->
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Avg Performance</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['avg_performance'] ?? 0 }}%</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-chart-line mr-1"></i>
                        <span>Company average</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-line text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Top Performers -->
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Top Performers</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['top_performers'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-trophy mr-1"></i>
                        <span>90%+ score</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-trophy text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Need Improvement -->
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Need Improvement</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['need_improvement'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        <span>Below 70%</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Reviews Pending -->
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Reviews Pending</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['reviews_pending'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-clock mr-1"></i>
                        <span>Awaiting review</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Management Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Performance Reviews Table -->
        <div class="lg:col-span-2 glass-card p-6 rounded-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Performance Reviews</h3>
                <div class="flex items-center space-x-4">
                    <select class="glass-input px-4 py-2 rounded-lg text-white outline-none">
                        <option value="all">All Employees</option>
                        <option value="department">By Department</option>
                        <option value="rating">By Rating</option>
                    </select>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Schedule Review
                    </button>
                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200 text-sm">
                        <i class="fas fa-clipboard-check mr-2"></i>
                        Pending Reviews
                    </button>
                    <button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200 text-sm">
                        <i class="fas fa-history mr-2"></i>
                        Completed Reviews
                    </button>
                </div>
            </div>

            <!-- Performance Table -->
            <div class="overflow-x-auto">
                <table class="w-full glass-card">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="text-left p-4 text-blue-300 font-semibold uppercase tracking-wider">Employee</th>
                            <th class="text-left p-4 text-blue-300 font-semibold uppercase tracking-wider">Score</th>
                            <th class="text-left p-4 text-blue-300 font-semibold uppercase tracking-wider">Status</th>
                            <th class="text-left p-4 text-blue-300 font-semibold uppercase tracking-wider">Review Date</th>
                            <th class="text-left p-4 text-blue-300 font-semibold uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($performances as $performance)
                        <tr class="border-b border-gray-700 hover:bg-white hover:bg-opacity-5 transition-colors duration-200">
                            <td class="p-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium">{{ $performance['employee_name'] }}</p>
                                        <p class="text-blue-300 text-xs">{{ $performance['employee_id'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center">
                                    <div class="text-2xl font-bold 
                                        @if($performance['score'] >= 90) text-green-400 
                                        @elseif($performance['score'] >= 70) text-blue-400 
                                        @elseif($performance['score'] >= 50) text-yellow-400 
                                        @else text-red-400 
                                        @endif">
                                        {{ $performance['score'] }}%
                                    </div>
                                    <div class="ml-4">
                                        <div class="w-full bg-gray-700 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-red-500 to-yellow-500 h-full rounded-full" style="width: {{ $performance['score'] }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-xs rounded-full 
                                    @if($performance['status'] == 'excellent') bg-green-600 
                                    @elseif($performance['status'] == 'good') bg-blue-600 
                                    @elseif($performance['status'] == 'average') bg-yellow-600 
                                    @else bg-red-600 
                                    @endif">
                                    {{ ucfirst($performance['status']) }}
                                </span>
                            </td>
                            <td class="p-4">
                                <span class="text-white font-medium">{{ $performance['review_date'] ?? '--:--' }}</span>
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
                                Loading performance data...
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
                <h3 class="text-xl font-semibold text-white mb-4">Performance Overview</h3>
                <div class="text-gray-400 text-sm">
                    Performance metrics and analytics are displayed above. Use the sidebar menu for detailed actions.
                </div>
            </div>

            <!-- Performance Distribution -->
            <div class="glass-card p-6 rounded-xl">
                <h3 class="text-xl font-semibold text-white mb-4">Performance Distribution</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-green-400 text-sm">Excellent (90%+)</span>
                        <span class="text-white font-semibold">{{ $stats['excellent_count'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-green-500 h-full rounded-full" style="width: {{ ($stats['excellent_count'] ?? 0) * 10 }}%"></div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-blue-400 text-sm">Good (70-89%)</span>
                        <span class="text-white font-semibold">{{ $stats['good_count'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-blue-500 h-full rounded-full" style="width: {{ ($stats['good_count'] ?? 0) * 10 }}%"></div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-yellow-400 text-sm">Average (50-69%)</span>
                        <span class="text-white font-semibold">{{ $stats['average_count'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-yellow-500 h-full rounded-full" style="width: {{ ($stats['average_count'] ?? 0) * 10 }}%"></div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-red-400 text-sm">Below Average (50%)</span>
                        <span class="text-white font-semibold">{{ $stats['below_average_count'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-red-500 h-full rounded-full" style="width: {{ ($stats['below_average_count'] ?? 0) * 10 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection                 

@section('scripts')
<script>
    // Performance Chart
    const ctx = document.getElementById('performanceChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Company Average',
                    data: [82, 84, 83, 85, 86, 87, 85, 88, 87, 89, 88, 90],
                    borderColor: 'rgba(34, 197, 94, 1)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    borderWidth: 2,
                    tension: 0.4
                },
                {
                    label: 'IT Department',
                    data: [88, 90, 89, 92, 91, 93, 92, 94, 93, 95, 94, 96],
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4
                },
                {
                    label: 'HR Department',
                    data: [85, 86, 87, 86, 88, 87, 89, 88, 90, 89, 91, 90],
                    borderColor: 'rgba(168, 85, 247, 1)',
                    backgroundColor: 'rgba(168, 85, 247, 0.1)',
                    borderWidth: 2,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#e2e8f0'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    min: 70,
                    max: 100,
                    ticks: {
                        color: '#94a3b8'
                    },
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: '#94a3b8'
                    },
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)'
                    }
                }
            }
        }
    });
    
    // Performance Management Functions
    function showAddReviewModal() {
        showNotification('Add Review feature opened from System menu', 'info');
        // Implementation would go here
    }
    
    function showGenerateReportsModal() {
        showNotification('Generate Reports feature opened from System menu', 'info');
        // Implementation would go here
    }
</script>
@endsection
