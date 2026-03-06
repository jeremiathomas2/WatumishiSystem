@extends('layouts.app')

@section('title', 'Company Policies')
@section('subtitle', 'Manage company policies and procedures')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Policy Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Total Policies</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['total_policies'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-file-alt mr-1"></i>
                        <span>Active policies</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-alt text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Updated This Month</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['updated_this_month'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-sync mr-1"></i>
                        <span>Recent updates</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-sync text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Need Review</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['need_review'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-clock mr-1"></i>
                        <span>Pending review</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Employee Acknowledged</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['acknowledged'] ?? 0 }}%</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-check-circle mr-1"></i>
                        <span>Read & signed</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Policy Categories -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Policy Categories</h3>
            <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                <i class="fas fa-plus mr-2"></i>Create Policy
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="glass-effect p-6 rounded-xl border border-gray-700 hover:border-blue-500 transition-all">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h4 class="text-lg font-semibold text-white">HR Policies</h4>
                        <p class="text-blue-300 text-sm">Employee relations and management</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-white"></i>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-blue-300">Total Policies</span>
                        <span class="text-white font-medium">{{ $stats['hr_policies'] ?? 8 }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-blue-300">Last Updated</span>
                        <span class="text-white font-medium">Nov 15, 2024</span>
                    </div>
                </div>
                
                <div class="space-y-2 mt-4">
                    <div class="flex items-center justify-between p-2 glass-effect rounded">
                        <span class="text-blue-300 text-sm">Employee Handbook</span>
                        <span class="text-green-400 text-xs">Active</span>
                    </div>
                    <div class="flex items-center justify-between p-2 glass-effect rounded">
                        <span class="text-blue-300 text-sm">Code of Conduct</span>
                        <span class="text-green-400 text-xs">Active</span>
                    </div>
                    <div class="flex items-center justify-between p-2 glass-effect rounded">
                        <span class="text-blue-300 text-sm">Leave Policy</span>
                        <span class="text-green-400 text-xs">Active</span>
                    </div>
                </div>
                
                <button class="w-full btn-primary py-2 rounded-lg text-white font-medium text-sm mt-4">
                    View All HR Policies
                </button>
            </div>
            
            <div class="glass-effect p-6 rounded-xl border border-gray-700 hover:border-green-500 transition-all">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h4 class="text-lg font-semibold text-white">Safety Policies</h4>
                        <p class="text-blue-300 text-sm">Workplace safety and health</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white"></i>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-blue-300">Total Policies</span>
                        <span class="text-white font-medium">{{ $stats['safety_policies'] ?? 6 }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-blue-300">Last Updated</span>
                        <span class="text-white font-medium">Oct 20, 2024</span>
                    </div>
                </div>
                
                <div class="space-y-2 mt-4">
                    <div class="flex items-center justify-between p-2 glass-effect rounded">
                        <span class="text-blue-300 text-sm">Safety Manual</span>
                        <span class="text-green-400 text-xs">Active</span>
                    </div>
                    <div class="flex items-center justify-between p-2 glass-effect rounded">
                        <span class="text-blue-300 text-sm">Emergency Procedures</span>
                        <span class="text-green-400 text-xs">Active</span>
                    </div>
                    <div class="flex items-center justify-between p-2 glass-effect rounded">
                        <span class="text-blue-300 text-sm">PPE Requirements</span>
                        <span class="text-yellow-400 text-xs">Review</span>
                    </div>
                </div>
                
                <button class="w-full btn-primary py-2 rounded-lg text-white font-medium text-sm mt-4">
                    View All Safety Policies
                </button>
            </div>
            
            <div class="glass-effect p-6 rounded-xl border border-gray-700 hover:border-purple-500 transition-all">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h4 class="text-lg font-semibold text-white">IT Policies</h4>
                        <p class="text-blue-300 text-sm">Technology and data security</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-laptop text-white"></i>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-blue-300">Total Policies</span>
                        <span class="text-white font-medium">{{ $stats['it_policies'] ?? 5 }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-blue-300">Last Updated</span>
                        <span class="text-white font-medium">Dec 1, 2024</span>
                    </div>
                </div>
                
                <div class="space-y-2 mt-4">
                    <div class="flex items-center justify-between p-2 glass-effect rounded">
                        <span class="text-blue-300 text-sm">Acceptable Use Policy</span>
                        <span class="text-green-400 text-xs">Active</span>
                    </div>
                    <div class="flex items-center justify-between p-2 glass-effect rounded">
                        <span class="text-blue-300 text-sm">Data Protection</span>
                        <span class="text-green-400 text-xs">Active</span>
                    </div>
                    <div class="flex items-center justify-between p-2 glass-effect rounded">
                        <span class="text-blue-300 text-sm">Password Policy</span>
                        <span class="text-green-400 text-xs">Active</span>
                    </div>
                </div>
                
                <button class="w-full btn-primary py-2 rounded-lg text-white font-medium text-sm mt-4">
                    View All IT Policies
                </button>
            </div>
        </div>
    </div>
    
    <!-- Recent Updates -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Recent Policy Updates</h3>
            <button class="glass-input px-4 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-10">
                <i class="fas fa-filter mr-2"></i>Filter
            </button>
        </div>
        
        <div class="space-y-4">
            <div class="glass-effect p-4 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-blue-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-alt text-blue-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold">Remote Work Policy</h4>
                            <p class="text-blue-300 text-sm">Updated Dec 5, 2024 • John Smith</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                        Active
                    </span>
                </div>
                <p class="text-blue-200 text-sm mb-3">Updated remote work guidelines to include new hybrid work arrangements and home office requirements.</p>
                <div class="flex items-center space-x-2">
                    <button class="text-blue-400 hover:text-blue-300 text-sm">View Policy</button>
                    <button class="text-green-400 hover:text-green-300 text-sm">Download PDF</button>
                    <button class="text-purple-400 hover:text-purple-300 text-sm">Version History</button>
                </div>
            </div>
            
            <div class="glass-effect p-4 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-green-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold">COVID-19 Safety Protocol</h4>
                            <p class="text-blue-300 text-sm">Updated Nov 28, 2024 • Sarah Johnson</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                        Active
                    </span>
                </div>
                <p class="text-blue-200 text-sm mb-3">Revised safety protocols based on latest health guidelines and vaccination requirements.</p>
                <div class="flex items-center space-x-2">
                    <button class="text-blue-400 hover:text-blue-300 text-sm">View Policy</button>
                    <button class="text-green-400 hover:text-green-300 text-sm">Download PDF</button>
                    <button class="text-purple-400 hover:text-purple-300 text-sm">Version History</button>
                </div>
            </div>
            
            <div class="glass-effect p-4 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-purple-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-laptop text-purple-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold">Data Privacy Policy</h4>
                            <p class="text-blue-300 text-sm">Updated Nov 15, 2024 • Michael Brown</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                        Active
                    </span>
                </div>
                <p class="text-blue-200 text-sm mb-3">Enhanced data protection measures in compliance with new data protection regulations.</p>
                <div class="flex items-center space-x-2">
                    <button class="text-blue-400 hover:text-blue-300 text-sm">View Policy</button>
                    <button class="text-green-400 hover:text-green-300 text-sm">Download PDF</button>
                    <button class="text-purple-400 hover:text-purple-300 text-sm">Version History</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Employee Acknowledgments -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Employee Policy Acknowledgments</h3>
            <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                <i class="fas fa-download mr-2"></i>Export Report
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">Pending Acknowledgments</h4>
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-500 bg-opacity-20 text-yellow-400">
                            {{ $stats['pending_acknowledgments'] ?? 12 }}
                        </span>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between p-2 glass-effect rounded">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">JD</span>
                                </div>
                                <div>
                                    <p class="text-white text-sm">John Doe</p>
                                    <p class="text-blue-300 text-xs">Remote Work Policy</p>
                                </div>
                            </div>
                            <button class="text-blue-400 hover:text-blue-300 text-sm">Send Reminder</button>
                        </div>
                        
                        <div class="flex items-center justify-between p-2 glass-effect rounded">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">SM</span>
                                </div>
                                <div>
                                    <p class="text-white text-sm">Sarah Miller</p>
                                    <p class="text-blue-300 text-xs">Data Privacy Policy</p>
                                </div>
                            </div>
                            <button class="text-blue-400 hover:text-blue-300 text-sm">Send Reminder</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">Acknowledgment Statistics</h4>
                        <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                            {{ $stats['acknowledgment_rate'] ?? 88 }}%
                        </span>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300 text-sm">Total Employees</span>
                            <span class="text-white font-medium">{{ $stats['total_employees'] ?? 156 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300 text-sm">Acknowledged</span>
                            <span class="text-white font-medium">{{ $stats['acknowledged_count'] ?? 137 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300 text-sm">Pending</span>
                            <span class="text-white font-medium">{{ $stats['pending_acknowledgments'] ?? 12 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300 text-sm">Overdue</span>
                            <span class="text-white font-medium text-red-400">{{ $stats['overdue_acknowledgments'] ?? 3 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
