@extends('layouts.app')

@section('title', 'Audit Logs')
@section('subtitle', 'System activity logs and audit trail')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Audit Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Total Logs</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['total_logs'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-history mr-1"></i>
                        <span>All activities</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-history text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Today's Logs</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['today_logs'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-calendar-day mr-1"></i>
                        <span>Current day</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-day text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Security Events</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['security_events'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-shield-alt mr-1"></i>
                        <span>Security related</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-shield-alt text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Failed Logins</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['failed_logins'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        <span>Authentication</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Audit Log Viewer -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Audit Log Viewer</h3>
            <div class="flex items-center space-x-4">
                <input type="date" value="{{ now()->format('Y-m-d') }}" class="glass-input px-4 py-2 rounded-lg text-white outline-none">
                <input type="time" value="{{ now()->format('H:i') }}" class="glass-input px-4 py-2 rounded-lg text-white outline-none">
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none">
                    <option value="all">All Categories</option>
                    <option value="login">Login/Logout</option>
                    <option value="user">User Management</option>
                    <option value="system">System</option>
                    <option value="security">Security</option>
                    <option value="data">Data Changes</option>
                </select>
                <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                    <i class="fas fa-download mr-2"></i>Export Logs
                </button>
            </div>
        </div>
        
        <div class="space-y-4">
            <div class="glass-effect p-4 rounded-lg border-l-4 border-blue-500">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-blue-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-sign-in-alt text-blue-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold">User Login</h4>
                            <p class="text-blue-300 text-sm">Super Admin • admin@watumishi.com</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                            Success
                        </span>
                        <span class="text-blue-300 text-sm">{{ now()->format('H:i:s') }}</span>
                    </div>
                </div>
                <p class="text-blue-200 text-sm">User successfully logged in from IP address 192.168.1.100</p>
            </div>
            
            <div class="glass-effect p-4 rounded-lg border-l-4 border-yellow-500">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-yellow-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold">Failed Login Attempt</h4>
                            <p class="text-blue-300 text-sm">Unknown • test@watumishi.com</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-red-500 bg-opacity-20 text-red-400">
                            Failed
                        </span>
                        <span class="text-blue-300 text-sm">{{ now()->format('H:i:s') }}</span>
                    </div>
                </div>
                <p class="text-blue-200 text-sm">Login failed due to invalid credentials. IP address: 192.168.1.101</p>
            </div>
            
            <div class="glass-effect p-4 rounded-lg border-l-4 border-purple-500">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-purple-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-cog text-purple-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold">User Created</h4>
                            <p class="text-blue-300 text-sm">Sarah Johnson • sarah.johnson@watumishi.com</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                            Success
                        </span>
                        <span class="text-blue-300 text-sm">{{ now()->format('H:i:s') }}</span>
                    </div>
                </div>
                <p class="text-blue-200 text-sm">New user account created with HR Manager role. User ID: EMP0002</p>
            </div>
            
            <div class="glass-effect p-4 rounded-lg border-l-4 border-green-500">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-edit text-green-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold">Employee Updated</h4>
                            <p class="text-blue-300 text-sm">John Smith • john.smith@watumishi.com</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                            Success
                        </span>
                        <span class="text-blue-300 text-sm">{{ now()->format('H:i:s') }}</span>
                    </div>
                </div>
                <p class="text-blue-200 text-sm">Employee profile updated: position changed from Developer to Senior Developer</p>
            </div>
        </div>
        
        <!-- Load More -->
        <div class="text-center mt-6">
            <button class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
                <i class="fas fa-arrow-down mr-2"></i>Load More
            </button>
        </div>
    </div>
    
    <!-- Log Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-6">Activity by Category</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-blue-300">Authentication</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-32 bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 45%"></div>
                        </div>
                        <span class="text-white text-sm">45%</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                        <span class="text-blue-300">User Management</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-32 bg-gray-700 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 25%"></div>
                        </div>
                        <span class="text-white text-sm">25%</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-blue-300">Data Changes</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-32 bg-gray-700 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 20%"></div>
                        </div>
                        <span class="text-white text-sm">20%</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        <span class="text-blue-300">System</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-32 bg-gray-700 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width:10%"></div>
                        </div>
                        <span class="text-white text-sm">10%</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-6">Recent Activity Timeline</h3>
            <div class="space-y-4">
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-white font-medium">2:00 PM</p>
                            <p class="text-blue-300 text-sm">User Login - Super Admin</p>
                        </div>
                    </div>
                </div>
                
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-white font-medium">1:45 PM</p>
                            <p class="text-blue-300 text-sm">User Created - Sarah Johnson</p>
                        </div>
                    </div>
                </div>
                
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-white font-medium">12:30 PM</p>
                            <p class="text-blue-300 text-sm">Employee Updated - John Smith</p>
                        </div>
                    </div>
                </div>
                
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-white font-medium">11:15 AM</p>
                        <p class="text-blue-300 text-sm">System Settings Updated</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
