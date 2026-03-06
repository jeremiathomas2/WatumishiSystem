@extends('layouts.app')

@section('title', 'System Settings')
@section('subtitle', 'Configure system settings and preferences')

@section('content')
<div class="space-y-6 fade-in">
    <!-- System Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">System Health</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['system_health'] ?? 0 }}%</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-heartbeat mr-1"></i>
                        <span>Optimal performance</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-heartbeat text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Storage Used</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['storage_used'] ?? 0 }}%</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-database mr-1"></i>
                        <span>Database storage</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-database text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Active Users</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['active_users'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-users mr-1"></i>
                        <span>Currently online</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Uptime</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['uptime'] ?? 0 }}%</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-server mr-1"></i>
                        <span>Last 30 days</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-server text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- System Configuration -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">System Configuration</h3>
            <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                <i class="fas fa-save mr-2"></i>Save Settings
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">General Settings</h4>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Company Name</label>
                            <input type="text" value="Watumishi HR System" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Company Email</label>
                            <input type="email" value="info@watumishi.com" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Timezone</label>
                            <select class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                                <option>Africa/Dar es Salaam</option>
                                <option>Africa/Nairobi</option>
                                <option>UTC</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Date Format</label>
                            <select class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                                <option>Y-m-d</option>
                                <option>d/m/Y</option>
                                <option>m/d/Y</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Security Settings</h4>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white font-medium">Two-Factor Authentication</p>
                                <p class="text-blue-300 text-sm">Require 2FA for all users</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white font-medium">Session Timeout</p>
                                <p class="text-blue-300 text-sm">Auto-logout after inactivity</p>
                            </div>
                            <input type="number" value="5" min="1" max="60" class="glass-input w-20 px-3 py-1 rounded-lg text-white outline-none">
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white font-medium">Password Complexity</p>
                                <p class="text-blue-300 text-sm">Minimum password requirements</p>
                            </div>
                            <select class="glass-input w-32 px-3 py-1 rounded-lg text-white outline-none">
                                <option>Medium</option>
                                <option>High</option>
                                <option>Maximum</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="space-y-6">
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Email Settings</h4>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">SMTP Server</label>
                            <input type="text" value="smtp.gmail.com" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">SMTP Port</label>
                            <input type="number" value="587" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Email From</label>
                            <input type="email" value="noreply@watumishi.com" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white font-medium">Email Notifications</p>
                                <p class="text-blue-300 text-sm">Send system emails</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Backup Settings</h4>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white font-medium">Auto Backup</p>
                                <p class="text-blue-300 text-sm">Automatic database backup</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white font-medium">Backup Frequency</p>
                                <p class="text-blue-300 text-sm">How often to backup</p>
                            </div>
                            <select class="glass-input w-32 px-3 py-1 rounded-lg text-white outline-none">
                                <option>Daily</option>
                                <option>Weekly</option>
                                <option>Monthly</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white font-medium">Retention Period</p>
                                <p class="text-blue-300 text-sm">Keep backups for</p>
                            </div>
                            <select class="glass-input w-32 px-3 py-1 rounded-lg text-white outline-none">
                                <option>30 days</option>
                                <option>60 days</option>
                                <option>90 days</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- System Information -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-6">System Information</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-blue-300">Application Version</span>
                    <span class="text-white font-medium">v2.1.0</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-blue-300">Laravel Version</span>
                    <span class="text-white font-medium">v10.45.1</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-blue-300">PHP Version</span>
                    <span class="text-white font-medium">v8.2.12</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-blue-300">Database</span>
                    <span class="text-white font-medium">MySQL v8.0.33</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-blue-300">Web Server</span>
                    <span class="text-white font-medium">Apache v2.4.58</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-blue-300">Environment</span>
                    <span class="text-white font-medium text-green-400">Production</span>
                </div>
            </div>
        </div>
        
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-6">System Resources</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-blue-300">CPU Usage</span>
                        <span class="text-white font-medium">45%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-blue-300">Memory Usage</span>
                        <span class="text-white font-medium">62%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 62%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-blue-300">Disk Usage</span>
                        <span class="text-white font-medium">38%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 38%"></div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4 text-sm mt-6">
                    <div class="glass-effect p-3 rounded-lg text-center">
                        <p class="text-2xl font-bold text-green-400">8GB</p>
                        <p class="text-blue-300">Total Memory</p>
                    </div>
                    <div class="glass-effect p-3 rounded-lg text-center">
                        <p class="text-2xl font-bold text-blue-400">500GB</p>
                        <p class="text-blue-300">Total Disk</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Maintenance Tools -->
    <div class="glass-card p-6 rounded-xl">
        <h3 class="text-xl font-semibold text-white mb-6">Maintenance Tools</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <button class="glass-effect p-4 rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                <div class="w-12 h-12 bg-blue-500 bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-broom text-blue-400 text-xl"></i>
                </div>
                <p class="text-white font-medium">Clear Cache</p>
                <p class="text-blue-300 text-sm">Clear system cache</p>
            </button>
            
            <button class="glass-effect p-4 rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                <div class="w-12 h-12 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-database text-green-400 text-xl"></i>
                </div>
                <p class="text-white font-medium">Optimize DB</p>
                <p class="text-blue-300 text-sm">Optimize database</p>
            </button>
            
            <button class="glass-effect p-4 rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                <div class="w-12 h-12 bg-purple-500 bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-download text-purple-400 text-xl"></i>
                </div>
                <p class="text-white font-medium">Backup Now</p>
                <p class="text-blue-300 text-sm">Create backup</p>
            </button>
            
            <button class="glass-effect p-4 rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                <div class="w-12 h-12 bg-yellow-500 bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-sync text-yellow-400 text-xl"></i>
                </div>
                <p class="text-white font-medium">Restart System</p>
                <p class="text-blue-300 text-sm">Restart services</p>
            </button>
        </div>
    </div>
</div>
@endsection
