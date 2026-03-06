@extends('layouts.app')

@section('title', 'Backup & Restore')
@section('subtitle', 'Manage system backups and data restoration')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Backup Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Total Backups</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['total_backups'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-database mr-1"></i>
                        <span>Stored backups</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-database text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Last Backup</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['last_backup_hours'] ?? 0 }}h</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-clock mr-1"></i>
                        <span>{{ $stats['last_backup_date'] ?? 'Not yet' }}</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Storage Used</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['storage_used'] ?? 0 }}GB</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-hdd mr-1"></i>
                        <span>Of 500GB</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-hdd text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Retention Days</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['retention_days'] ?? 30 }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        <span>Keep period</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Backup Management -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Backup Management</h3>
            <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                <i class="fas fa-plus mr-2"></i>Create Backup
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Quick Backup</h4>
                <div class="glass-effect p-4 rounded-lg">
                    <p class="text-blue-300 text-sm mb-4">Create a full system backup immediately</p>
                    <button class="btn-primary w-full py-3 rounded-lg text-white font-medium">
                        <i class="fas fa-download mr-2"></i>Download Full Backup
                    </button>
                </div>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Scheduled Backup</h4>
                <div class="glass-effect p-4 rounded-lg">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300 text-sm">Auto Backup</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300 text-sm">Frequency</span>
                            <select class="glass-input px-3 py-1 rounded-lg text-white outline-none">
                                <option>Daily</option>
                                <option>Weekly</option>
                                <option>Monthly</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300 text-sm">Next Backup</span>
                            <span class="text-white text-sm">Tomorrow, 2:00 AM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Backups -->
        <h4 class="text-lg font-semibold text-white mb-4">Recent Backups</h4>
        <div class="space-y-4">
            <div class="glass-effect p-4 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-database text-green-400"></i>
                        </div>
                        <div>
                            <h5 class="text-white font-semibold">Full System Backup</h5>
                            <p class="text-blue-300 text-sm">Dec 10, 2024 • 2:00 AM</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                            Complete
                        </span>
                        <span class="text-blue-300 text-sm">2.3 GB</span>
                    </div>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-blue-300">Files:</span>
                    <span class="text-white">Database, uploads, configurations</span>
                </div>
                <div class="flex items-center space-x-2 mt-3">
                    <button class="text-blue-400 hover:text-blue-300 text-sm">Download</button>
                    <button class="text-green-400 hover:text-green-300 text-sm">Restore</button>
                    <button class="text-red-400 hover:text-red-300 text-sm">Delete</button>
                </div>
            </div>
            
            <div class="glass-effect p-4 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-blue-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-database text-blue-400"></i>
                        </div>
                        <div>
                            <h5 class="text-white font-semibold">Database Only</h5>
                            <p class="text-blue-300 text-sm">Dec 9, 2024 • 2:00 AM</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-blue-500 bg-opacity-20 text-blue-400">
                            Complete
                        </span>
                        <span class="text-blue-300 text-sm">1.8 GB</span>
                    </div>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-blue-300">Files:</span>
                    <span class="text-white">Database only</span>
                </div>
                <div class="flex items-center space-x-2 mt-3">
                    <button class="text-blue-400 hover:text-blue-300 text-sm">Download</button>
                    <button class="text-green-400 hover:text-green-300 text-sm">Restore</button>
                    <button class="text-red-400 hover:text-red-300 text-sm">Delete</button>
                </div>
            </div>
            
            <div class="glass-effect p-4 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-purple-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-alt text-purple-400"></i>
                        </div>
                        <div>
                            <h5 class="text-white font-semibold">Files & Media</h5>
                            <p class="text-blue-300 text-sm">Dec 8, 2024 • 2:00 AM</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-purple-500 bg-opacity-20 text-purple-400">
                            Complete
                        </span>
                        <span class="text-blue-300 text-sm">1.2 GB</span>
                    </div>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-blue-300">Files:</span>
                    <span class="text-white">Documents, images, media</span>
                </div>
                <div class="flex items-center space-x-2 mt-3">
                    <button class="text-blue-400 hover:text-blue-300 text-sm">Download</button>
                    <button class="text-green-400 hover:text-green-300 text-sm">Restore</button>
                    <button class="text-red-400 hover:text-red-300 text-sm">Delete</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Restore Options -->
    <div class="glass-card p-6 rounded-xl">
        <h3 class="text-xl font-semibold text-white mb-6">Restore Options</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Quick Restore</h4>
                <div class="glass-effect p-4 rounded-lg">
                    <p class="text-blue-300 text-sm mb-4">Select a backup to restore from</p>
                    <select class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none mb-4">
                        <option>Select backup...</option>
                        <option>Full System Backup - Dec 10, 2024</option>
                        <option>Database Only - Dec 9, 2024</option>
                        <option>Files & Media - Dec 8, 2024</option>
                    </select>
                    <button class="btn-primary w-full py-3 rounded-lg text-white font-medium">
                        <i class="fas fa-undo mr-2"></i>Restore System
                    </button>
                </div>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Restore Guidelines</h4>
                <div class="glass-effect p-4 rounded-lg">
                    <div class="space-y-3 text-sm text-blue-200">
                        <p><strong>⚠️ Important:</strong> Restoring from a backup will replace current data.</p>
                        <p><strong>📋 Backup:</strong> Always create a backup before restoring.</p>
                        <p><strong>🔄 Downtime:</strong> System will be unavailable during restore.</p>
                        <p><strong>📧 Notification:</strong> Users will be notified of the restore.</p>
                        <p><strong>🔒 Security:</strong> Only administrators can perform restores.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Backup Schedule -->
    <div class="glass-card p-6 rounded-xl">
        <h3 class="text-xl font-semibold text-white mb-6">Backup Schedule</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Type</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Frequency</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Next Run</th>
                        <th class="text-left py-3">Status</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                Full System
                            </span>
                        </td>
                        <td class="py-3 px-4 text-blue-300">Daily</td>
                        <td class="py-3 px-4 text-blue-300">Tomorrow, 2:00 AM</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                Active
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300 text-sm">Edit</button>
                                <button class="text-yellow-400 hover:text-yellow-300 text-sm">Pause</button>
                                <button class="text-red-400 hover:text-red-300 text-sm">Delete</button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-500 bg-opacity-20 text-blue-400">
                                Database
                            </span>
                        </td>
                        <td class="py-3 px-4 text-blue-300">Weekly</td>
                        <td class="py-3 px-4 text-blue-300">Sunday, 3:00 AM</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                Active
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300 text-sm">Edit</button>
                                <button class="text-yellow-400 hover:text-yellow-300 text-sm">Pause</button>
                                <button class="text-red-400 hover:text-red-300 text-sm">Delete</button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-purple-500 bg-opacity-20 text-purple-400">
                                Files
                            </span>
                        </td>
                        <td class="py-3 px-4 text-blue-300">Monthly</td>
                        <td class="py-3 px-4 text-blue-300">Jan 1, 2025, 2:00 AM</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                Active
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300 text-sm">Edit</button>
                                <button class="text-yellow-400 hover:text-yellow-300 text-sm">Pause</button>
                                <button class="text-red-400 hover:text-red-300 text-sm">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
