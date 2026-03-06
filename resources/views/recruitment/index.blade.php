@extends('layouts.app')

@section('title', 'Recruitment')
@section('subtitle', 'Manage job openings and recruitment process')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Recruitment Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Open Positions</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['open_positions'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-briefcase mr-1"></i>
                        <span>Active job postings</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-briefcase text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Applications</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['total_applications'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-file-alt mr-1"></i>
                        <span>This month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-alt text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">In Progress</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['in_progress'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-hourglass-half mr-1"></i>
                        <span>Under review</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-hourglass-half text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Hired This Month</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['hired_this_month'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-user-check mr-1"></i>
                        <span>Successfully onboarded</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-check text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Job Postings -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Current Job Openings</h3>
            <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                <i class="fas fa-plus mr-2"></i>Post New Job
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @if(isset($jobPostings) && count($jobPostings) > 0)
                @foreach($jobPostings as $job)
                <div class="glass-effect p-6 rounded-xl border border-gray-700 hover:border-blue-500 transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h4 class="text-lg font-semibold text-white">{{ $job->title }}</h4>
                            <p class="text-blue-300 text-sm">{{ $job->department ?? 'General' }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full {{ $job->status === 'active' ? 'bg-green-500 bg-opacity-20 text-green-400' : 'bg-gray-500 bg-opacity-20 text-gray-400' }}">
                            {{ ucfirst($job->status ?? 'inactive') }}
                        </span>
                    </div>
                    
                    <p class="text-blue-200 text-sm mb-4 line-clamp-2">{{ $job->description ?? 'No description available' }}</p>
                    
                    <div class="flex items-center justify-between text-sm mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-blue-300">
                                <i class="fas fa-map-marker-alt mr-1"></i>{{ $job->location ?? 'Dar es Salaam' }}
                            </span>
                            <span class="text-blue-300">
                                <i class="fas fa-clock mr-1"></i>{{ $job->type ?? 'Full-time' }}
                            </span>
                        </div>
                        <span class="text-white font-medium">{{ $job->salary ? 'TZS ' . number_format($job->salary) : 'Competitive' }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex -space-x-2">
                            @for($i = 0; $i < min($job->application_count ?? 0, 5); $i++)
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center border-2 border-gray-800">
                                    <span class="text-white text-xs font-bold">{{ $i + 1 }}</span>
                                </div>
                            @endfor
                            @if(($job->application_count ?? 0) > 5)
                                <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center border-2 border-gray-800">
                                    <span class="text-white text-xs font-bold">+{{ ($job->application_count ?? 0) - 5 }}</span>
                                </div>
                            @endif
                        </div>
                        <span class="text-blue-300 text-sm">{{ $job->application_count ?? 0 }} applications</span>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <button class="flex-1 btn-primary py-2 rounded-lg text-white font-medium text-sm">
                            <i class="fas fa-users mr-1"></i>View Applicants
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
                        <i class="fas fa-briefcase text-6xl text-blue-300 opacity-50 mb-4"></i>
                        <h3 class="text-xl font-semibold text-white mb-2">No Job Openings</h3>
                        <p class="text-blue-300 mb-6">Post your first job opening to start recruiting talent.</p>
                        <button class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
                            <i class="fas fa-plus mr-2"></i>Create Job Posting
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Recent Applications -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Recent Applications</h3>
            <button class="glass-input px-4 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-10">
                <i class="fas fa-filter mr-2"></i>Filter
            </button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Applicant</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Position</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Applied</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Status</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Score</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">JD</span>
                                </div>
                                <div>
                                    <p class="text-white font-medium">John Doe</p>
                                    <p class="text-blue-300 text-xs">john.doe@email.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-blue-300">Software Developer</td>
                        <td class="py-3 px-4 text-blue-300">2 days ago</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-500 bg-opacity-20 text-yellow-400">
                                Under Review
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-16 bg-gray-700 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 75%"></div>
                                </div>
                                <span class="text-white text-sm">75%</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-400 hover:text-green-300" title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="text-red-400 hover:text-red-300" title="Reject">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">SM</span>
                                </div>
                                <div>
                                    <p class="text-white font-medium">Sarah Smith</p>
                                    <p class="text-blue-300 text-xs">sarah.smith@email.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-blue-300">HR Manager</td>
                        <td class="py-3 px-4 text-blue-300">1 week ago</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-500 bg-opacity-20 text-blue-400">
                                Interview Scheduled
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-16 bg-gray-700 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 85%"></div>
                                </div>
                                <span class="text-white text-sm">85%</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-400 hover:text-green-300" title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="text-red-400 hover:text-red-300" title="Reject">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
