@extends('layouts.app')

@section('title', 'Legal Compliance')
@section('subtitle', 'Ensure compliance with Tanzania Labour Laws')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Compliance Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Compliance Rate</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['compliance_rate'] ?? 0 }}%</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-check-circle mr-1"></i>
                        <span>Overall compliance</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Active Policies</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['active_policies'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-file-contract mr-1"></i>
                        <span>Implemented</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-contract text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Audits Required</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['audits_required'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-clipboard-check mr-1"></i>
                        <span>Pending review</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clipboard-check text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Violations</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['violations'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        <span>This month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Labour Law Compliance -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Tanzania Labour Law Compliance</h3>
            <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                <i class="fas fa-sync mr-2"></i>Update Compliance
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">Working Hours</h4>
                        <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                            Compliant
                        </span>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Standard Hours:</span>
                            <span class="text-white">45 hours/week</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Overtime Rate:</span>
                            <span class="text-white">1.5x normal rate</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Max Overtime:</span>
                            <span class="text-white">12 hours/week</span>
                        </div>
                    </div>
                    <p class="text-blue-200 text-sm mt-3">✓ Compliant with Employment and Labour Relations Act, 2004</p>
                </div>
                
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">Minimum Wage</h4>
                        <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                            Compliant
                        </span>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Current Rate:</span>
                            <span class="text-white">TZS 260,000/month</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Last Updated:</span>
                            <span class="text-white">July 2024</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Coverage:</span>
                            <span class="text-white">100% employees</span>
                        </div>
                    </div>
                    <p class="text-blue-200 text-sm mt-3">✓ Above minimum wage requirements</p>
                </div>
                
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">Leave Entitlement</h4>
                        <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                            Compliant
                        </span>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Annual Leave:</span>
                            <span class="text-white">28 days/year</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Sick Leave:</span>
                            <span class="text-white">30 days/year</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Maternity Leave:</span>
                            <span class="text-white">84 days</span>
                        </div>
                    </div>
                    <p class="text-blue-200 text-sm mt-3">✓ Exceeds minimum requirements</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">Social Security</h4>
                        <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                            Compliant
                        </span>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">NSSF Coverage:</span>
                            <span class="text-white">100%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Employer Rate:</span>
                            <span class="text-white">10%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Employee Rate:</span>
                            <span class="text-white">5%</span>
                        </div>
                    </div>
                    <p class="text-blue-200 text-sm mt-3">✓ All contributions up to date</p>
                </div>
                
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">Health & Safety</h4>
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-500 bg-opacity-20 text-yellow-400">
                            Review Needed
                        </span>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Safety Training:</span>
                            <span class="text-white">85% completed</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Safety Equipment:</span>
                            <span class="text-white">90% available</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Incidents:</span>
                            <span class="text-white">2 this month</span>
                        </div>
                    </div>
                    <p class="text-yellow-200 text-sm mt-3">⚠ Some safety training pending completion</p>
                </div>
                
                <div class="glass-effect p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-white font-semibold">Employment Contracts</h4>
                        <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                            Compliant
                        </span>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Written Contracts:</span>
                            <span class="text-white">100%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Probation Period:</span>
                            <span class="text-white">Max 6 months</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-300">Notice Period:</span>
                            <span class="text-white">As per contract</span>
                        </div>
                    </div>
                    <p class="text-blue-200 text-sm mt-3">✓ All contracts properly documented</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Required Documents -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Required Legal Documents</h3>
            <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                <i class="fas fa-upload mr-2"></i>Upload Document
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="glass-effect p-4 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-alt text-green-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-medium">Business License</h4>
                            <p class="text-blue-300 text-xs">Valid until Dec 2025</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                        Valid
                    </span>
                </div>
                <p class="text-blue-200 text-sm">Current business license from BRELA</p>
                <div class="flex items-center space-x-2 mt-3">
                    <button class="text-blue-400 hover:text-blue-300 text-sm">View</button>
                    <button class="text-green-400 hover:text-green-300 text-sm">Download</button>
                </div>
            </div>
            
            <div class="glass-effect p-4 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-blue-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-medium">NSSF Registration</h4>
                            <p class="text-blue-300 text-xs">Active</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                        Active
                    </span>
                </div>
                <p class="text-blue-200 text-sm">National Social Security Fund registration certificate</p>
                <div class="flex items-center space-x-2 mt-3">
                    <button class="text-blue-400 hover:text-blue-300 text-sm">View</button>
                    <button class="text-green-400 hover:text-green-300 text-sm">Download</button>
                </div>
            </div>
            
            <div class="glass-effect p-4 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-balance-scale text-purple-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-medium">Tax Compliance</h4>
                            <p class="text-blue-300 text-xs">Up to date</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                        Compliant
                    </span>
                </div>
                <p class="text-blue-200 text-sm">TRA tax clearance certificate and compliance</p>
                <div class="flex items-center space-x-2 mt-3">
                    <button class="text-blue-400 hover:text-blue-300 text-sm">View</button>
                    <button class="text-green-400 hover:text-green-300 text-sm">Download</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Compliance Calendar -->
    <div class="glass-card p-6 rounded-xl">
        <h3 class="text-xl font-semibold text-white mb-6">Compliance Calendar</h3>
        <div class="space-y-4">
            <div class="glass-effect p-4 rounded-lg border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-white font-semibold">Annual License Renewal</h4>
                        <p class="text-blue-300 text-sm">Business License • Due: Dec 31, 2024</p>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-500 bg-opacity-20 text-yellow-400">
                        15 days left
                    </span>
                </div>
                <p class="text-blue-200 text-sm mt-2">Renewal application should be submitted 30 days before expiry</p>
            </div>
            
            <div class="glass-effect p-4 rounded-lg border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-white font-semibold">Quarterly Tax Filing</h4>
                        <p class="text-blue-300 text-sm">Q4 2024 • Due: Jan 31, 2025</p>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full bg-blue-500 bg-opacity-20 text-blue-400">
                        Scheduled
                    </span>
                </div>
                <p class="text-blue-200 text-sm mt-2">Quarterly tax returns for Q4 2024</p>
            </div>
            
            <div class="glass-effect p-4 rounded-lg border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-white font-semibold">Annual Safety Audit</h4>
                        <p class="text-blue-300 text-sm">OSHA Compliance • Due: Jan 15, 2025</p>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                        Planned
                    </span>
                </div>
                <p class="text-blue-200 text-sm mt-2">Annual workplace safety and health inspection</p>
            </div>
        </div>
    </div>
</div>
@endsection
