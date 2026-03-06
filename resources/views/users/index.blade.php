@extends('layouts.app')

@section('title', 'User Management')
@section('subtitle', 'Manage system users and permissions')

@section('content')
<div class="space-y-6 fade-in">
    <!-- User Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Total Users</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['total_users'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-users mr-1"></i>
                        <span>Active accounts</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Active Today</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['active_today'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-user-check mr-1"></i>
                        <span>Currently logged in</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-check text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Admin Users</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['admin_users'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-user-shield mr-1"></i>
                        <span>System administrators</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-shield text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">New This Month</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['new_this_month'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-user-plus mr-1"></i>
                        <span>Recently added</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-plus text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- User Management -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">User Management</h3>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search users..." class="glass-input px-4 py-2 pr-10 rounded-lg text-white placeholder-blue-200 outline-none w-64">
                    <i class="fas fa-search absolute right-3 top-3 text-blue-300"></i>
                </div>
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none">
                    <option value="all">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="hr">HR</option>
                    <option value="manager">Manager</option>
                    <option value="employee">Employee</option>
                </select>
                <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                    <i class="fas fa-plus mr-2"></i>Add User
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">User</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Email</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Role</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Department</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Status</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Last Login</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">SA</span>
                                </div>
                                <div>
                                    <p class="text-white font-medium">Super Admin</p>
                                    <p class="text-blue-300 text-xs">admin@watumishi.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-blue-300">admin@watumishi.com</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-500 bg-opacity-20 text-yellow-400">
                                Super Admin
                            </span>
                        </td>
                        <td class="py-3 px-4 text-blue-300">System</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                Active
                            </span>
                        </td>
                        <td class="py-3 px-4 text-blue-300">2 hours ago</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-yellow-400 hover:text-yellow-300" title="Reset Password">
                                    <i class="fas fa-key"></i>
                                </button>
                                <button class="text-red-400 hover:text-red-300" title="Deactivate">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">SJ</span>
                                </div>
                                <div>
                                    <p class="text-white font-medium">Sarah Johnson</p>
                                    <p class="text-blue-300 text-xs">sarah.johnson@watumishi.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-blue-300">sarah.johnson@watumishi.com</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-500 bg-opacity-20 text-blue-400">
                                HR Manager
                            </span>
                        </td>
                        <td class="py-3 px-4 text-blue-300">HR Department</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                Active
                            </span>
                        </td>
                        <td class="py-3 px-4 text-blue-300">1 day ago</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-yellow-400 hover:text-yellow-300" title="Reset Password">
                                    <i class="fas fa-key"></i>
                                </button>
                                <button class="text-red-400 hover:text-red-300" title="Deactivate">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">MB</span>
                                </div>
                                <div>
                                    <p class="text-white font-medium">Michael Brown</p>
                                    <p class="text-blue-300 text-xs">michael.brown@watumishi.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-blue-300">michael.brown@watumishi.com</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-purple-500 bg-opacity-20 text-purple-400">
                                Finance Manager
                            </span>
                        </td>
                        <td class="py-3 px-4 text-blue-300">Finance</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                Active
                            </span>
                        </td>
                        <td class="py-3 px-4 text-blue-300">3 days ago</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-yellow-400 hover:text-yellow-300" title="Reset Password">
                                    <i class="fas fa-key"></i>
                                </button>
                                <button class="text-red-400 hover:text-red-300" title="Deactivate">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Role Permissions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-6">Role Permissions</h3>
            <div class="space-y-4">
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">Super Admin</h4>
                        <span class="text-xs text-blue-300">1 user</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-400"></i>
                            <span class="text-blue-300">Full system access</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-400"></i>
                            <span class="text-blue-300">User management</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-400"></i>
                            <span class="text-blue-300">System settings</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-400"></i>
                            <span class="text-blue-300">All modules</span>
                        </div>
                    </div>
                </div>
                
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">HR Manager</h4>
                        <span class="text-xs text-blue-300">3 users</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-400"></i>
                            <span class="text-blue-300">Employee data</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-400"></i>
                            <span class="text-blue-300">Leave management</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-400"></i>
                            <span class="text-blue-300">Recruitment</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-times text-red-400"></i>
                            <span class="text-blue-300">System settings</span>
                        </div>
                    </div>
                </div>
                
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">Manager</h4>
                        <span class="text-xs text-blue-300">8 users</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-400"></i>
                            <span class="text-blue-300">Team data</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-400"></i>
                            <span class="text-blue-300">Performance</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-times text-red-400"></i>
                            <span class="text-blue-300">User management</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-times text-red-400"></i>
                            <span class="text-blue-300">System settings</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-6">User Activity</h3>
            <div class="space-y-4">
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">Recent Logins</h4>
                        <span class="text-xs text-blue-300">Last 24 hours</span>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">SA</span>
                                </div>
                                <div>
                                    <p class="text-white text-sm">Super Admin</p>
                                    <p class="text-blue-300 text-xs">2 hours ago</p>
                                </div>
                            </div>
                            <span class="text-green-400 text-xs">Active</span>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">SJ</span>
                                </div>
                                <div>
                                    <p class="text-white text-sm">Sarah Johnson</p>
                                    <p class="text-blue-300 text-xs">1 day ago</p>
                                </div>
                            </div>
                            <span class="text-green-400 text-xs">Active</span>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">DW</span>
                                </div>
                                <div>
                                    <p class="text-white text-sm">David Wilson</p>
                                    <p class="text-blue-300 text-xs">3 days ago</p>
                                </div>
                            </div>
                            <span class="text-gray-400 text-xs">Inactive</span>
                        </div>
                    </div>
                </div>
                
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">Failed Login Attempts</h4>
                        <span class="text-xs text-red-400">5 attempts</span>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-blue-300">unknown@watumishi.com</span>
                            <span class="text-red-400 text-xs">3 attempts</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-blue-300">test@watumishi.com</span>
                            <span class="text-red-400 text-xs">2 attempts</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
