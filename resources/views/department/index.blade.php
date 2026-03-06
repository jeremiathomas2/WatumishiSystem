@extends('layouts.app')

@section('title', 'Departments')
@section('subtitle', 'Organizational structure and department management')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Department Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Total Departments</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['total_departments'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-building mr-1"></i>
                        <span>Active departments</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-building text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Avg Team Size</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['avg_team_size'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-users mr-1"></i>
                        <span>Employees per dept</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-bar text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Managers</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['total_managers'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-user-tie mr-1"></i>
                        <span>Department heads</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-tie text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Budget Utilization</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['budget_utilization'] ?? 0 }}%</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-chart-pie mr-1"></i>
                        <span>Of total budget</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-pie text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Department Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if(isset($departments) && count($departments) > 0)
            @foreach($departments as $department)
            <div class="glass-card p-6 rounded-xl hover:shadow-2xl transition-all">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h4 class="text-lg font-semibold text-white">{{ $department->name }}</h4>
                        <p class="text-blue-300 text-sm">{{ $department->description ?? 'No description available' }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-building text-white"></i>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-blue-300 text-sm">Head of Department</span>
                        <span class="text-white font-medium">{{ $department->manager_name ?? 'Not Assigned' }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-blue-300 text-sm">Team Size</span>
                        <span class="text-white font-medium">{{ $department->employee_count ?? 0 }} employees</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-blue-300 text-sm">Budget</span>
                        <span class="text-white font-medium">{{ $department->budget ? 'TZS ' . number_format($department->budget) : 'Not Set' }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-blue-300 text-sm">Status</span>
                        <span class="px-2 py-1 text-xs rounded-full {{ $department->status === 'active' ? 'bg-green-500 bg-opacity-20 text-green-400' : 'bg-red-500 bg-opacity-20 text-red-400' }}">
                            {{ ucfirst($department->status ?? 'inactive') }}
                        </span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-2 mt-4 pt-4 border-t border-gray-700">
                    <button class="flex-1 btn-primary py-2 rounded-lg text-white font-medium text-sm">
                        <i class="fas fa-users mr-1"></i>View Team
                    </button>
                    <button class="flex-1 glass-input py-2 rounded-lg text-white font-medium text-sm hover:bg-white hover:bg-opacity-10">
                        <i class="fas fa-cog mr-1"></i>Settings
                    </button>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-span-full">
                <div class="glass-card p-12 rounded-xl text-center">
                    <i class="fas fa-building text-6xl text-blue-300 opacity-50 mb-4"></i>
                    <h3 class="text-xl font-semibold text-white mb-2">No Departments Found</h3>
                    <p class="text-blue-300 mb-6">Create your first department to organize your team structure.</p>
                    <button class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
                        <i class="fas fa-plus mr-2"></i>Create Department
                    </button>
                </div>
            </div>
        @endif
    </div>
    
    <!-- Department Hierarchy -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Organization Structure</h3>
            <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                <i class="fas fa-sitemap mr-2"></i>View Hierarchy
            </button>
        </div>
        
        <div class="space-y-4">
            <div class="flex items-center space-x-4 p-4 glass-effect rounded-lg">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-blue-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-crown text-white text-sm"></i>
                </div>
                <div class="flex-1">
                    <h4 class="text-white font-semibold">Executive Management</h4>
                    <p class="text-blue-300 text-sm">CEO, Directors, Senior Management</p>
                </div>
                <div class="text-blue-300 text-sm">12 members</div>
            </div>
            
            <div class="flex items-center space-x-4 p-4 glass-effect rounded-lg">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-green-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-white text-sm"></i>
                </div>
                <div class="flex-1">
                    <h4 class="text-white font-semibold">Operations Department</h4>
                    <p class="text-blue-300 text-sm">Daily operations, logistics, support</p>
                </div>
                <div class="text-blue-300 text-sm">45 members</div>
            </div>
            
            <div class="flex items-center space-x-4 p-4 glass-effect rounded-lg">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-yellow-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-white text-sm"></i>
                </div>
                <div class="flex-1">
                    <h4 class="text-white font-semibold">Finance Department</h4>
                    <p class="text-blue-300 text-sm">Accounting, budgeting, financial planning</p>
                </div>
                <div class="text-blue-300 text-sm">28 members</div>
            </div>
        </div>
    </div>
</div>
@endsection
