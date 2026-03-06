@extends('layouts.app')

@section('title', 'Performance Reports')
@section('subtitle', 'Employee performance and evaluation reports')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Performance Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Reviews -->
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Total Reviews</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['total_reviews'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-clipboard-check mr-1"></i>
                        <span>All evaluations</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clipboard-check text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Average Score -->
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Avg Score</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['avg_performance_score'] ?? 0 }}%</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-chart-line mr-1"></i>
                        <span>Company average</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-line text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Top Performers -->
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Top Performers</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['top_performers'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-trophy mr-1"></i>
                        <span>90%+ score</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-trophy text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Need Improvement -->
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Need Improvement</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['improvement_needed'] ?? 0 }}</p>
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
    </div>

    <!-- Performance Reports Table -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Performance Reports</h3>
            <div class="flex items-center space-x-4">
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none">
                    <option value="current">Current Quarter</option>
                    <option value="quarter">Last Quarter</option>
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
                        <th class="p-4 text-left text-blue-300">Review Date</th>
                        <th class="p-4 text-left text-blue-300">Score</th>
                        <th class="p-4 text-left text-blue-300">Status</th>
                        <th class="p-4 text-left text-blue-300">Reviewer</th>
                        <th class="p-4 text-left text-blue-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr class="border-b border-gray-800 hover:bg-gray-800 hover:bg-opacity-50 transition-colors">
                        <td class="p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-purple-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-user text-purple-400 text-sm"></i>
                                </div>
                                <div>
                                    <span class="text-white font-medium">{{ $report['employee'] ?? 'Jane Smith' }}</span>
                                    <p class="text-gray-400 text-xs">{{ $report['department'] ?? 'Marketing' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="text-white">{{ $report['review_date'] ?? '2023-12-15' }}</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center space-x-2">
                                <span class="text-white font-medium">{{ $report['score'] ?? 85 }}%</span>
                                <div class="w-12 h-2 bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-green-500 to-blue-500" style="width: {{ $report['score'] ?? 85 }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 text-xs rounded-full 
                                @if(($report['score'] ?? 85) >= 90) bg-green-600 
                                @elseif(($report['score'] ?? 85) >= 70) bg-blue-600 
                                @else bg-yellow-600 
                                @endif text-white">
                                {{ ($report['score'] ?? 85) >= 90 ? 'Excellent' : (($report['score'] ?? 85) >= 70 ? 'Good' : 'Average') }}
                            </span>
                        </td>
                        <td class="p-4">
                            <span class="text-white">{{ $report['reviewer'] ?? 'John Manager' }}</span>
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
                            Loading performance reports...
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
