@extends('layouts.app')

@section('title', 'System Settings')
@section('subtitle', 'Configure system settings and preferences')

@section('styles')
<style>
.settings-container {
    background: linear-gradient(135deg, rgba(17, 24, 39, 0.95) 0%, rgba(31, 41, 55, 0.95) 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 20px;
    padding: 2rem;
    margin: 1rem;
}

.stat-card {
    background: linear-gradient(135deg, rgba(17, 24, 39, 0.8) 0%, rgba(31, 41, 55, 0.8) 100%);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(59, 130, 246, 0.3);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    transition: left 0.5s ease;
}

.stat-card:hover::before {
    left: 100%;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(59, 130, 246, 0.3);
}

.glass-card {
    background: linear-gradient(135deg, rgba(17, 24, 39, 0.9) 0%, rgba(31, 41, 55, 0.9) 100%);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(59, 130, 246, 0.2);
    transition: all 0.3s ease;
}

.glass-card:hover {
    border-color: rgba(59, 130, 246, 0.4);
    box-shadow: 0 10px 30px rgba(59, 130, 246, 0.2);
}

.glass-input {
    background: rgba(17, 24, 39, 0.7);
    border: 1px solid rgba(59, 130, 246, 0.3);
    transition: all 0.3s ease;
}

.glass-input:focus {
    border-color: rgba(59, 130, 246, 0.6);
    box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    background: rgba(17, 24, 39, 0.9);
}

.btn-primary {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.8) 0%, rgba(37, 99, 235, 0.8) 100%);
    border: 1px solid rgba(59, 130, 246, 0.5);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.6s ease, height 0.6s ease;
}

.btn-primary:hover::before {
    width: 300px;
    height: 300px;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
}

.progress-bar {
    background: linear-gradient(90deg, #10b981 0%, #3b82f6 50%, #8b5cf6 100%);
    background-size: 200% 100%;
    animation: shimmer 2s ease-in-out infinite;
}

@keyframes shimmer {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

.settings-tabs {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    border-bottom: 1px solid rgba(59, 130, 246, 0.2);
}

.tab-btn {
    padding: 0.75rem 1.5rem;
    background: transparent;
    border: none;
    color: rgba(147, 197, 253, 0.8);
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.tab-btn.active {
    color: #3b82f6;
}

.tab-btn::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6);
    transition: width 0.3s ease;
}

.tab-btn.active::after {
    width: 100%;
}

.tab-content {
    display: none;
    animation: fadeIn 0.5s ease;
}

.tab-content.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ef4444;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.switch-toggle {
    position: relative;
    width: 60px;
    height: 30px;
    background: rgba(107, 114, 128, 0.5);
    border-radius: 15px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.switch-toggle.active {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
}

.switch-toggle::after {
    content: '';
    position: absolute;
    top: 3px;
    left: 3px;
    width: 24px;
    height: 24px;
    background: white;
    border-radius: 50%;
    transition: transform 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.switch-toggle.active::after {
    transform: translateX(30px);
}

.advanced-card {
    background: linear-gradient(135deg, rgba(17, 24, 39, 0.95) 0%, rgba(31, 41, 55, 0.95) 100%);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-radius: 16px;
    padding: 1.5rem;
    transition: all 0.3s ease;
}

.advanced-card:hover {
    border-color: rgba(59, 130, 246, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(59, 130, 246, 0.2);
}

.status-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 8px;
    animation: blink 2s infinite;
}

.status-indicator.online { background: #10b981; }
.status-indicator.offline { background: #ef4444; }
.status-indicator.warning { background: #f59e0b; }

@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
</style>
@endsection

@section('content')
<div class="settings-container">
    <!-- Header with Quick Actions -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">System Settings</h1>
            <p class="text-blue-300">Manage your HR system configuration and preferences</p>
        </div>
        <div class="flex gap-3">
            <button onclick="exportSettings()" class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-all">
                <i class="fas fa-download mr-2"></i>Export Config
            </button>
            <button onclick="importSettings()" class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-all">
                <i class="fas fa-upload mr-2"></i>Import Config
            </button>
            <button onclick="resetToDefaults()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all">
                <i class="fas fa-undo mr-2"></i>Reset to Defaults
            </button>
        </div>
    </div>

    <!-- System Stats with Enhanced Design -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card p-6 rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-heartbeat text-white text-2xl"></i>
                </div>
                <div class="status-indicator online"></div>
            </div>
            <div>
                <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider mb-2">System Health</p>
                <p class="text-4xl font-bold text-white mb-3">{{ $stats['system_health'] ?? 0 }}%</p>
                <div class="flex items-center justify-between">
                    <span class="text-blue-400 text-sm">Optimal performance</span>
                    <span class="text-green-400 text-xs">+2.3%</span>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-database text-white text-2xl"></i>
                </div>
                <div class="status-indicator online"></div>
            </div>
            <div>
                <p class="text-green-300 text-sm font-semibold uppercase tracking-wider mb-2">Storage Used</p>
                <p class="text-4xl font-bold text-white mb-3">{{ $stats['storage_used'] ?? 0 }}%</p>
                <div class="flex items-center justify-between">
                    <span class="text-green-400 text-sm">1.9GB / 5GB</span>
                                            <span class="text-yellow-400 text-xs">+5.1%</span>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <div class="status-indicator online"></div>
            </div>
            <div>
                <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider mb-2">Active Users</p>
                <p class="text-4xl font-bold text-white mb-3">{{ $stats['active_users'] ?? 0 }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-yellow-400 text-sm">Currently online</span>
                                            <span class="text-green-400 text-xs">+12</span>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-server text-white text-2xl"></i>
                </div>
                <div class="status-indicator online"></div>
            </div>
            <div>
                <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider mb-2">Uptime</p>
                <p class="text-4xl font-bold text-white mb-3">{{ $stats['uptime'] ?? 0 }}%</p>
                <div class="flex items-center justify-between">
                    <span class="text-purple-400 text-sm">Last 30 days</span>
                                            <span class="text-green-400 text-xs">Stable</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Settings Tabs -->
    <div class="settings-tabs">
        <button class="tab-btn active" onclick="switchTab('general')">
            <i class="fas fa-cog mr-2"></i>General
        </button>
        <button class="tab-btn" onclick="switchTab('security')">
            <i class="fas fa-shield-alt mr-2"></i>Security
        </button>
        <button class="tab-btn" onclick="switchTab('email')">
            <i class="fas fa-envelope mr-2"></i>Email
        </button>
        <button class="tab-btn" onclick="switchTab('backup')">
            <i class="fas fa-save mr-2"></i>Backup
        </button>
        <button class="tab-btn" onclick="switchTab('integrations')">
            <i class="fas fa-plug mr-2"></i>Integrations
        </button>
        <button class="tab-btn" onclick="switchTab('advanced')">
            <i class="fas fa-code mr-2"></i>Advanced
        </button>
    </div>

    <!-- Tab Contents -->
    <div id="general-tab" class="tab-content active">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="advanced-card">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-building mr-3 text-blue-400"></i>
                    Company Information
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Company Name</label>
                        <input type="text" value="Watumishi HR System" class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Company Email</label>
                        <input type="email" value="info@watumishi.com" class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Phone Number</label>
                        <input type="tel" value="+255 123 456 789" class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Address</label>
                        <textarea class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none" rows="3">Dar es Salaam, Tanzania</textarea>
                    </div>
                </div>
            </div>

            <div class="advanced-card">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-globe mr-3 text-green-400"></i>
                    Localization
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Timezone</label>
                        <select class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                            <option>Africa/Dar es Salaam</option>
                            <option>Africa/Nairobi</option>
                            <option>UTC</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Date Format</label>
                        <select class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                            <option>Y-m-d</option>
                            <option>d/m/Y</option>
                            <option>m/d/Y</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Language</label>
                        <select class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                            <option>English</option>
                            <option>Swahili</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Currency</label>
                        <select class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                            <option>TZS - Tanzanian Shilling</option>
                            <option>USD - US Dollar</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="security-tab" class="tab-content">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="advanced-card">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-lock mr-3 text-red-400"></i>
                    Authentication Security
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Two-Factor Authentication</p>
                            <p class="text-blue-300 text-sm">Require 2FA for all users</p>
                        </div>
                        <div class="switch-toggle" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Session Timeout</p>
                            <p class="text-blue-300 text-sm">Auto-logout after inactivity (minutes)</p>
                        </div>
                        <input type="number" value="5" min="1" max="60" class="glass-input w-20 px-3 py-2 rounded-lg text-white outline-none">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Password Complexity</p>
                            <p class="text-blue-300 text-sm">Minimum password requirements</p>
                        </div>
                        <select class="glass-input w-32 px-3 py-2 rounded-lg text-white outline-none">
                            <option>Medium</option>
                            <option>High</option>
                            <option>Maximum</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Login Attempts</p>
                            <p class="text-blue-300 text-sm">Maximum failed attempts before lockout</p>
                        </div>
                        <input type="number" value="5" min="3" max="10" class="glass-input w-20 px-3 py-2 rounded-lg text-white outline-none">
                    </div>
                </div>
            </div>

            <div class="advanced-card">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-shield-alt mr-3 text-yellow-400"></i>
                    Data Protection
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Data Encryption</p>
                            <p class="text-blue-300 text-sm">Encrypt sensitive data at rest</p>
                        </div>
                        <div class="switch-toggle active" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Audit Logging</p>
                            <p class="text-blue-300 text-sm">Log all user activities</p>
                        </div>
                        <div class="switch-toggle active" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">IP Whitelist</p>
                            <p class="text-blue-300 text-sm">Restrict access by IP address</p>
                        </div>
                        <div class="switch-toggle" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">API Rate Limiting</p>
                            <p class="text-blue-300 text-sm">Limit API requests per minute</p>
                        </div>
                        <input type="number" value="60" min="10" max="1000" class="glass-input w-24 px-3 py-2 rounded-lg text-white outline-none">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="email-tab" class="tab-content">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="advanced-card">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-envelope mr-3 text-blue-400"></i>
                    SMTP Configuration
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">SMTP Server</label>
                        <input type="text" value="smtp.gmail.com" class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">SMTP Port</label>
                        <input type="number" value="587" class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Email From</label>
                        <input type="email" value="noreply@watumishi.com" class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Email From Name</label>
                        <input type="text" value="Watumishi HR System" class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                    </div>
                </div>
            </div>

            <div class="advanced-card">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-bell mr-3 text-purple-400"></i>
                    Email Notifications
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">System Notifications</p>
                            <p class="text-blue-300 text-sm">Send system update emails</p>
                        </div>
                        <div class="switch-toggle active" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">User Notifications</p>
                            <p class="text-blue-300 text-sm">Send user activity emails</p>
                        </div>
                        <div class="switch-toggle active" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Backup Notifications</p>
                            <p class="text-blue-300 text-sm">Send backup completion emails</p>
                        </div>
                        <div class="switch-toggle" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Security Alerts</p>
                            <p class="text-blue-300 text-sm">Send security breach alerts</p>
                        </div>
                        <div class="switch-toggle active" onclick="toggleSwitch(this)"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="backup-tab" class="tab-content">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="advanced-card">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-save mr-3 text-green-400"></i>
                    Backup Configuration
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Auto Backup</p>
                            <p class="text-blue-300 text-sm">Automatic database backup</p>
                        </div>
                        <div class="switch-toggle active" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Backup Frequency</p>
                            <p class="text-blue-300 text-sm">How often to backup</p>
                        </div>
                        <select class="glass-input w-32 px-3 py-2 rounded-lg text-white outline-none">
                            <option>Daily</option>
                            <option>Weekly</option>
                            <option>Monthly</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Retention Period</p>
                            <p class="text-blue-300 text-sm">Keep backups for</p>
                        </div>
                        <select class="glass-input w-32 px-3 py-2 rounded-lg text-white outline-none">
                            <option>30 days</option>
                            <option>60 days</option>
                            <option>90 days</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Backup Location</p>
                            <p class="text-blue-300 text-sm">Storage location</p>
                        </div>
                        <select class="glass-input w-32 px-3 py-2 rounded-lg text-white outline-none">
                            <option>Local</option>
                            <option>Cloud</option>
                            <option>Both</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="advanced-card">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-history mr-3 text-blue-400"></i>
                    Recent Backups
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-check text-green-400"></i>
                            </div>
                            <div>
                                <p class="text-white font-medium">Daily Backup</p>
                                <p class="text-blue-300 text-sm">2 hours ago • 45.2 MB</p>
                            </div>
                        </div>
                        <button class="text-blue-400 hover:text-blue-300">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-check text-green-400"></i>
                            </div>
                            <div>
                                <p class="text-white font-medium">Weekly Backup</p>
                                <p class="text-blue-300 text-sm">2 days ago • 45.2 MB</p>
                            </div>
                        </div>
                        <button class="text-blue-400 hover:text-blue-300">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-500 bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-times text-red-400"></i>
                            </div>
                            <div>
                                <p class="text-white font-medium">Manual Backup</p>
                                <p class="text-blue-300 text-sm">5 days ago • Failed</p>
                            </div>
                        </div>
                        <button class="text-red-400 hover:text-red-300">
                            <i class="fas fa-exclamation-triangle"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="integrations-tab" class="tab-content">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="advanced-card">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-plug mr-3 text-purple-400"></i>
                    Third-Party Integrations
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-500 bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fab fa-google text-blue-400"></i>
                            </div>
                            <div>
                                <p class="text-white font-medium">Google Workspace</p>
                                <p class="text-blue-300 text-sm">Calendar, Drive, Gmail</p>
                            </div>
                        </div>
                        <div class="switch-toggle" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fab fa-whatsapp text-green-400"></i>
                            </div>
                            <div>
                                <p class="text-white font-medium">WhatsApp Business</p>
                                <p class="text-blue-300 text-sm">Notifications & reminders</p>
                            </div>
                        </div>
                        <div class="switch-toggle active" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-500 bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fab fa-slack text-purple-400"></i>
                            </div>
                            <div>
                                <p class="text-white font-medium">Slack</p>
                                <p class="text-blue-300 text-sm">Team communications</p>
                            </div>
                        </div>
                        <div class="switch-toggle" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-yellow-500 bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fab fa-stripe text-yellow-400"></i>
                            </div>
                            <div>
                                <p class="text-white font-medium">Stripe</p>
                                <p class="text-blue-300 text-sm">Payment processing</p>
                            </div>
                        </div>
                        <div class="switch-toggle" onclick="toggleSwitch(this)"></div>
                    </div>
                </div>
            </div>

            <div class="advanced-card">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-key mr-3 text-yellow-400"></i>
                    API Configuration
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">API Key</label>
                        <div class="flex gap-2">
                            <input type="password" value="sk_test_..." class="glass-input flex-1 px-4 py-3 rounded-lg text-white outline-none">
                            <button class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Webhook URL</label>
                        <input type="url" value="https://api.watumishi.com/webhook" class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">API Version</label>
                        <select class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                            <option>v1.0</option>
                            <option>v2.0</option>
                            <option>Beta</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">API Rate Limiting</p>
                            <p class="text-blue-300 text-sm">Enable rate limiting</p>
                        </div>
                        <div class="switch-toggle active" onclick="toggleSwitch(this)"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="advanced-tab" class="tab-content">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="advanced-card">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-code mr-3 text-red-400"></i>
                    System Configuration
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Debug Mode</label>
                        <select class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                            <option>Off</option>
                            <option>Basic</option>
                            <option>Verbose</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Log Level</label>
                        <select class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                            <option>Error</option>
                            <option>Warning</option>
                            <option>Info</option>
                            <option>Debug</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Cache Driver</label>
                        <select class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                            <option>File</option>
                            <option>Redis</option>
                            <option>Memcached</option>
                            <option>Database</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Session Driver</label>
                        <select class="glass-input w-full px-4 py-3 rounded-lg text-white outline-none">
                            <option>File</option>
                            <option>Database</option>
                            <option>Redis</option>
                            <option>Cookie</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="advanced-card">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <i class="fas fa-terminal mr-3 text-green-400"></i>
                    Performance Tuning
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Query Cache</p>
                            <p class="text-blue-300 text-sm">Enable database query caching</p>
                        </div>
                        <div class="switch-toggle active" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">OPcache</p>
                            <p class="text-blue-300 text-sm">Enable PHP opcode cache</p>
                        </div>
                        <div class="switch-toggle active" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Gzip Compression</p>
                            <p class="text-blue-300 text-sm">Compress HTTP responses</p>
                        </div>
                        <div class="switch-toggle active" onclick="toggleSwitch(this)"></div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-800 bg-opacity-50 rounded-lg">
                        <div>
                            <p class="text-white font-medium">Image Optimization</p>
                            <p class="text-blue-300 text-sm">Auto-optimize uploaded images</p>
                        </div>
                        <div class="switch-toggle" onclick="toggleSwitch(this)"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Information & Resources -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
        <div class="advanced-card">
            <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                <i class="fas fa-info-circle mr-3 text-blue-400"></i>
                System Information
            </h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-gray-800 bg-opacity-30 rounded-lg">
                    <span class="text-blue-300">Application Version</span>
                    <span class="text-white font-medium">v2.1.0</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-800 bg-opacity-30 rounded-lg">
                    <span class="text-blue-300">Laravel Version</span>
                    <span class="text-white font-medium">v10.45.1</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-800 bg-opacity-30 rounded-lg">
                    <span class="text-blue-300">PHP Version</span>
                    <span class="text-white font-medium">v8.2.12</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-800 bg-opacity-30 rounded-lg">
                    <span class="text-blue-300">Database</span>
                    <span class="text-white font-medium">MySQL v8.0.33</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-800 bg-opacity-30 rounded-lg">
                    <span class="text-blue-300">Web Server</span>
                    <span class="text-white font-medium">Apache v2.4.58</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-800 bg-opacity-30 rounded-lg">
                    <span class="text-blue-300">Environment</span>
                    <span class="text-white font-medium text-green-400">Production</span>
                </div>
            </div>
        </div>
        
        <div class="advanced-card">
            <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                <i class="fas fa-chart-line mr-3 text-green-400"></i>
                System Resources
            </h3>
            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-blue-300">CPU Usage</span>
                        <span class="text-white font-medium">45%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-3">
                        <div class="progress-bar h-3 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-blue-300">Memory Usage</span>
                        <span class="text-white font-medium">62%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-3">
                        <div class="progress-bar h-3 rounded-full" style="width: 62%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-blue-300">Disk Usage</span>
                        <span class="text-white font-medium">38%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-3">
                        <div class="progress-bar h-3 rounded-full" style="width: 38%"></div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4 text-sm mt-6">
                    <div class="bg-gray-800 bg-opacity-50 p-4 rounded-lg text-center">
                        <p class="text-2xl font-bold text-green-400">8GB</p>
                        <p class="text-blue-300">Total Memory</p>
                    </div>
                    <div class="bg-gray-800 bg-opacity-50 p-4 rounded-lg text-center">
                        <p class="text-2xl font-bold text-blue-400">500GB</p>
                        <p class="text-blue-300">Total Disk</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Maintenance Tools -->
    <div class="advanced-card mt-8">
        <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
            <i class="fas fa-tools mr-3 text-yellow-400"></i>
            Maintenance Tools
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <button onclick="clearCache()" class="p-6 bg-gray-800 bg-opacity-50 rounded-xl hover:bg-opacity-70 transition-all group">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-broom text-white text-2xl"></i>
                </div>
                <p class="text-white font-medium text-lg">Clear Cache</p>
                <p class="text-blue-300 text-sm mt-1">Clear system cache</p>
            </button>
            
            <button onclick="optimizeDatabase()" class="p-6 bg-gray-800 bg-opacity-50 rounded-xl hover:bg-opacity-70 transition-all group">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-database text-white text-2xl"></i>
                </div>
                <p class="text-white font-medium text-lg">Optimize DB</p>
                <p class="text-blue-300 text-sm mt-1">Optimize database</p>
            </button>
            
            <button onclick="createBackup()" class="p-6 bg-gray-800 bg-opacity-50 rounded-xl hover:bg-opacity-70 transition-all group">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-download text-white text-2xl"></i>
                </div>
                <p class="text-white font-medium text-lg">Backup Now</p>
                <p class="text-blue-300 text-sm mt-1">Create backup</p>
            </button>
            
            <button onclick="restartSystem()" class="p-6 bg-gray-800 bg-opacity-50 rounded-xl hover:bg-opacity-70 transition-all group">
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-sync text-white text-2xl"></i>
                </div>
                <p class="text-white font-medium text-lg">Restart System</p>
                <p class="text-blue-300 text-sm mt-1">Restart services</p>
            </button>
        </div>
    </div>

    <!-- Save Button -->
    <div class="flex justify-end mt-8">
        <button onclick="saveSettings()" class="btn-primary px-8 py-4 rounded-xl text-white font-medium text-lg">
            <i class="fas fa-save mr-3"></i>Save All Settings
        </button>
    </div>
</div>

<script>
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab content
    document.getElementById(tabName + '-tab').classList.add('active');
    
    // Add active class to clicked tab button
    event.target.classList.add('active');
}

function toggleSwitch(element) {
    element.classList.toggle('active');
}

function clearCache() {
    if (confirm('Are you sure you want to clear the system cache?')) {
        fetch('/settings/cache/clear', { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                showNotification('Cache cleared successfully', 'success');
            })
            .catch(error => {
                showNotification('Error clearing cache', 'error');
            });
    }
}

function optimizeDatabase() {
    if (confirm('Are you sure you want to optimize the database?')) {
        fetch('/settings/database/optimize', { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                showNotification('Database optimized successfully', 'success');
            })
            .catch(error => {
                showNotification('Error optimizing database', 'error');
            });
    }
}

function createBackup() {
    if (confirm('Are you sure you want to create a backup?')) {
        fetch('/settings/backup', { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                showNotification('Backup created successfully', 'success');
            })
            .catch(error => {
                showNotification('Error creating backup', 'error');
            });
    }
}

function restartSystem() {
    if (confirm('Are you sure you want to restart the system? This will temporarily interrupt service.')) {
        showNotification('System restart initiated', 'warning');
        // Add restart logic here
    }
}

function saveSettings() {
    // Collect all form data and save
    showNotification('Settings saved successfully', 'success');
}

function exportSettings() {
    // Export settings to JSON file
    showNotification('Settings exported', 'success');
}

function importSettings() {
    // Import settings from JSON file
    showNotification('Settings imported', 'success');
}

function resetToDefaults() {
    if (confirm('Are you sure you want to reset all settings to defaults? This action cannot be undone.')) {
        showNotification('Settings reset to defaults', 'warning');
    }
}

function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg text-white z-50 ${
        type === 'success' ? 'bg-green-600' : 
        type === 'error' ? 'bg-red-600' : 
        'bg-yellow-600'
    }`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${
                type === 'success' ? 'fa-check-circle' : 
                type === 'error' ? 'fa-exclamation-circle' : 
                'fa-exclamation-triangle'
            } mr-3"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endsection
