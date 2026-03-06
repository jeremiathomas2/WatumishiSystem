@extends('layouts.app')

@section('title', 'Discipline Management')
@section('subtitle', 'Handle employee discipline cases and compliance')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Discipline Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-red-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-300 text-sm font-semibold uppercase tracking-wider">Open Cases</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['open_cases'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-red-400 text-sm">
                        <i class="fas fa-gavel mr-1"></i>
                        <span>Active investigations</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-red-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-gavel text-red-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Under Review</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['under_review'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-search mr-1"></i>
                        <span>Investigation phase</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-search text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Hearing Scheduled</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['hearing_scheduled'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        <span>Upcoming hearings</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Closed Cases</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['closed_cases'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-check-circle mr-1"></i>
                        <span>Resolved</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Active Cases -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Active Discipline Cases</h3>
            <div class="flex items-center space-x-4">
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none">
                    <option value="all">All Cases</option>
                    <option value="reported">Reported</option>
                    <option value="investigation">Under Investigation</option>
                    <option value="hearing">Hearing Scheduled</option>
                </select>
                <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                    <i class="fas fa-plus mr-2"></i>New Case
                </button>
            </div>
        </div>
        
        <div class="space-y-4">
            <div class="glass-effect p-4 rounded-lg border-l-4 border-red-500">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-orange-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold">Case #DIS-2024-001</h4>
                            <p class="text-blue-300 text-sm">Unauthorized Absence • John Smith</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-red-500 bg-opacity-20 text-red-400">
                            Reported
                        </span>
                        <button class="text-blue-400 hover:text-blue-300" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-blue-300">Reported:</span>
                        <span class="text-white ml-2">Dec 10, 2024</span>
                    </div>
                    <div>
                        <span class="text-blue-300">Reporter:</span>
                        <span class="text-white ml-2">Sarah Johnson</span>
                    </div>
                    <div>
                        <span class="text-blue-300">Severity:</span>
                        <span class="text-white ml-2">Medium</span>
                    </div>
                </div>
                <p class="text-blue-200 text-sm mt-3">Employee reported absent for 3 consecutive days without notification. Company policy requires immediate reporting.</p>
                <div class="flex items-center space-x-2 mt-3">
                    <button class="btn-primary px-3 py-1 rounded text-white text-sm">Start Investigation</button>
                    <button class="glass-input px-3 py-1 rounded text-white text-sm hover:bg-white hover:bg-opacity-10">View Details</button>
                </div>
            </div>
            
            <div class="glass-effect p-4 rounded-lg border-l-4 border-yellow-500">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-briefcase text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold">Case #DIS-2024-002</h4>
                            <p class="text-blue-300 text-sm">Policy Violation • Emily Davis</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-500 bg-opacity-20 text-yellow-400">
                            Under Investigation
                        </span>
                        <button class="text-blue-400 hover:text-blue-300" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-blue-300">Reported:</span>
                        <span class="text-white ml-2">Dec 8, 2024</span>
                    </div>
                    <div>
                        <span class="text-blue-300">Reporter:</span>
                        <span class="text-white ml-2">Michael Brown</span>
                    </div>
                    <div>
                        <span class="text-blue-300">Severity:</span>
                        <span class="text-white ml-2">High</span>
                    </div>
                </div>
                <p class="text-blue-200 text-sm mt-3">Violation of company data security policy. Employee accessed confidential files without proper authorization.</p>
                <div class="flex items-center space-x-2 mt-3">
                    <button class="btn-primary px-3 py-1 rounded text-white text-sm">Schedule Hearing</button>
                    <button class="glass-input px-3 py-1 rounded text-white text-sm hover:bg-white hover:bg-opacity-10">View Evidence</button>
                </div>
            </div>
            
            <div class="glass-effect p-4 rounded-lg border-l-4 border-blue-500">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold">Case #DIS-2024-003</h4>
                            <p class="text-blue-300 text-sm">Harassment • David Wilson</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-blue-500 bg-opacity-20 text-blue-400">
                            Hearing Scheduled
                        </span>
                        <button class="text-blue-400 hover:text-blue-300" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-blue-300">Reported:</span>
                        <span class="text-white ml-2">Dec 5, 2024</span>
                    </div>
                    <div>
                        <span class="text-blue-300">Reporter:</span>
                        <span class="text-white ml-2">Lisa Anderson</span>
                    </div>
                    <div>
                        <span class="text-blue-300">Severity:</span>
                        <span class="text-white ml-2">Critical</span>
                    </div>
                </div>
                <p class="text-blue-200 text-sm mt-3">Workplace harassment complaint. Investigation completed. Hearing scheduled for Dec 20, 2024.</p>
                <div class="flex items-center space-x-2 mt-3">
                    <button class="btn-primary px-3 py-1 rounded text-white text-sm">View Hearing Details</button>
                    <button class="glass-input px-3 py-1 rounded text-white text-sm hover:bg-white hover:bg-opacity-10">View Report</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Case Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-6">Case Types Distribution</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        <span class="text-blue-300">Unauthorized Absence</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-32 bg-gray-700 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 35%"></div>
                        </div>
                        <span class="text-white text-sm">35%</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        <span class="text-blue-300">Policy Violation</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-32 bg-gray-700 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 28%"></div>
                        </div>
                        <span class="text-white text-sm">28%</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-blue-300">Harassment</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-32 bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 20%"></div>
                        </div>
                        <span class="text-white text-sm">20%</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                        <span class="text-blue-300">Performance Issues</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-32 bg-gray-700 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 17%"></div>
                        </div>
                        <span class="text-white text-sm">17%</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-6">Resolution Timeline</h3>
            <div class="space-y-4">
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-blue-300">Average Resolution Time</span>
                        <span class="text-white font-bold">14 days</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 70%"></div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="glass-effect p-3 rounded-lg text-center">
                        <p class="text-2xl font-bold text-green-400">85%</p>
                        <p class="text-blue-300">Resolved within SLA</p>
                    </div>
                    <div class="glass-effect p-3 rounded-lg text-center">
                        <p class="text-2xl font-bold text-blue-400">92%</p>
                        <p class="text-blue-300">Compliance Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
