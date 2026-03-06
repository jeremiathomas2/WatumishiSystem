@extends('layouts.app')

@section('title', 'Training')
@section('subtitle', 'Employee training and development programs')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Training Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Active Programs</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['active_programs'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-graduation-cap mr-1"></i>
                        <span>Ongoing training</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Employees Trained</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['employees_trained'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-users mr-1"></i>
                        <span>This month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Completion Rate</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['completion_rate'] ?? 0 }}%</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-chart-line mr-1"></i>
                        <span>Success rate</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-line text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Certifications</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['certifications'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-certificate mr-1"></i>
                        <span>Awarded this year</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-certificate text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Training Programs -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Training Programs</h3>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search programs..." class="glass-input px-4 py-2 pr-10 rounded-lg text-white placeholder-blue-200 outline-none w-64">
                    <i class="fas fa-search absolute right-3 top-3 text-blue-300"></i>
                </div>
                <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                    <i class="fas fa-plus mr-2"></i>New Program
                </button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if(isset($trainingPrograms) && count($trainingPrograms) > 0)
                @foreach($trainingPrograms as $program)
                <div class="glass-effect p-6 rounded-xl border border-gray-700 hover:border-blue-500 transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h4 class="text-lg font-semibold text-white">{{ $program->title }}</h4>
                            <p class="text-blue-300 text-sm">{{ $program->category ?? 'General' }}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white"></i>
                        </div>
                    </div>
                    
                    <p class="text-blue-200 text-sm mb-4 line-clamp-2">{{ $program->description ?? 'No description available' }}</p>
                    
                    <div class="space-y-3 mb-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-blue-300">Duration</span>
                            <span class="text-white font-medium">{{ $program->duration ?? 'Not specified' }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-blue-300">Instructor</span>
                            <span class="text-white font-medium">{{ $program->instructor ?? 'Not assigned' }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-blue-300">Enrolled</span>
                            <span class="text-white font-medium">{{ $program->enrolled_count ?? 0 }} / {{ $program->capacity ?? 'Unlimited' }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-blue-300">Status</span>
                            <span class="px-2 py-1 text-xs rounded-full {{ $program->status === 'active' ? 'bg-green-500 bg-opacity-20 text-green-400' : 'bg-gray-500 bg-opacity-20 text-gray-400' }}">
                                {{ ucfirst($program->status ?? 'inactive') }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between text-sm mb-1">
                            <span class="text-blue-300">Progress</span>
                            <span class="text-white font-medium">{{ $program->progress ?? 0 }}%</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 rounded-full transition-all duration-300" style="width: {{ $program->progress ?? 0 }}%"></div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <button class="flex-1 btn-primary py-2 rounded-lg text-white font-medium text-sm">
                            <i class="fas fa-users mr-1"></i>View Participants
                        </button>
                        <button class="glass-input px-3 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-10">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-span-full">
                    <div class="text-center py-12">
                        <i class="fas fa-graduation-cap text-6xl text-blue-300 opacity-50 mb-4"></i>
                        <h3 class="text-xl font-semibold text-white mb-2">No Training Programs</h3>
                        <p class="text-blue-300 mb-6">Create your first training program to start developing your team.</p>
                        <button class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
                            <i class="fas fa-plus mr-2"></i>Create Program
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Upcoming Training Sessions -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Upcoming Sessions</h3>
            <button class="glass-input px-4 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-10">
                <i class="fas fa-calendar mr-2"></i>View Calendar
            </button>
        </div>
        
        <div class="space-y-4">
            <div class="flex items-center justify-between p-4 glass-effect rounded-lg">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-laptop-code text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold">Advanced JavaScript Development</h4>
                        <p class="text-blue-300 text-sm">Tomorrow, 9:00 AM - Conference Room A</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-white font-medium">12 participants</p>
                    <p class="text-green-400 text-sm">John Smith</p>
                </div>
            </div>
            
            <div class="flex items-center justify-between p-4 glass-effect rounded-lg">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-chart-line text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold">Leadership Excellence Program</h4>
                        <p class="text-blue-300 text-sm">Dec 15, 2024, 2:00 PM - Training Hall</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-white font-medium">8 participants</p>
                    <p class="text-green-400 text-sm">Sarah Johnson</p>
                </div>
            </div>
            
            <div class="flex items-center justify-between p-4 glass-effect rounded-lg">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold">Workplace Safety Training</h4>
                        <p class="text-blue-300 text-sm">Dec 18, 2024, 10:00 AM - Main Hall</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-white font-medium">25 participants</p>
                    <p class="text-green-400 text-sm">Michael Brown</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Training Materials -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Training Materials</h3>
            <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                <i class="fas fa-upload mr-2"></i>Upload Material
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="glass-effect p-4 rounded-lg text-center hover:bg-white hover:bg-opacity-5 transition-all cursor-pointer">
                <div class="w-12 h-12 bg-blue-500 bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-file-pdf text-blue-400 text-xl"></i>
                </div>
                <p class="text-white font-medium text-sm">Employee Handbook</p>
                <p class="text-blue-300 text-xs">PDF • 2.5 MB</p>
            </div>
            
            <div class="glass-effect p-4 rounded-lg text-center hover:bg-white hover:bg-opacity-5 transition-all cursor-pointer">
                <div class="w-12 h-12 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-file-powerpoint text-green-400 text-xl"></i>
                </div>
                <p class="text-white font-medium text-sm">Safety Guidelines</p>
                <p class="text-blue-300 text-xs">PPT • 5.1 MB</p>
            </div>
            
            <div class="glass-effect p-4 rounded-lg text-center hover:bg-white hover:bg-opacity-5 transition-all cursor-pointer">
                <div class="w-12 h-12 bg-purple-500 bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-file-video text-purple-400 text-xl"></i>
                </div>
                <p class="text-white font-medium text-sm">Training Videos</p>
                <p class="text-blue-300 text-xs">MP4 • 125 MB</p>
            </div>
            
            <div class="glass-effect p-4 rounded-lg text-center hover:bg-white hover:bg-opacity-5 transition-all cursor-pointer">
                <div class="w-12 h-12 bg-yellow-500 bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-file-word text-yellow-400 text-xl"></i>
                </div>
                <p class="text-white font-medium text-sm">Course Materials</p>
                <p class="text-blue-300 text-xs">DOC • 1.2 MB</p>
            </div>
        </div>
    </div>
</div>
@endsection
