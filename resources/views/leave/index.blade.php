@extends('layouts.app')

@section('title', 'Leave Management')
@section('subtitle', 'Manage employee leave requests and approvals')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Leave Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Pending Requests</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['pending_requests'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-clock mr-1"></i>
                        <span>Awaiting approval</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Approved Today</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['approved_today'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-check-circle mr-1"></i>
                        <span>Approved</span>
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
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">On Leave Today</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['on_leave_today'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        <span>Currently away</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Leave Balance</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['avg_balance'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-chart-bar mr-1"></i>
                        <span>Average days</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-bar text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Leave Management Actions -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Leave Requests</h3>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search leave requests..." class="glass-input px-4 py-2 pr-10 rounded-lg text-white placeholder-blue-200 outline-none w-64" onkeyup="searchLeaveRequests(this.value)">
                    <i class="fas fa-search absolute right-3 top-3 text-blue-300"></i>
                </div>
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none" onchange="filterByStatus(this.value)">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none" onchange="filterByType(this.value)">
                    <option value="">All Types</option>
                    <option value="annual">Annual Leave</option>
                    <option value="sick">Sick Leave</option>
                    <option value="personal">Personal Leave</option>
                    <option value="maternity">Maternity Leave</option>
                </select>
                <button onclick="openRequestLeaveModal()" class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                    <i class="fas fa-plus mr-2"></i>Request Leave
                </button>
                <button onclick="toggleCalendarView()" class="bg-purple-500 hover:bg-purple-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-calendar mr-2"></i>Calendar View
                </button>
                <button onclick="exportLeaveData()" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
            </div>
        </div>
        
        <!-- Calendar View (Hidden by default) -->
        <div id="calendarView" class="hidden mb-6">
            <div class="glass-card p-6 rounded-xl">
                <h4 class="text-lg font-semibold text-white mb-4">Leave Calendar</h4>
                <div class="grid grid-cols-7 gap-2 text-center">
                    <div class="text-blue-300 font-semibold py-2">Sun</div>
                    <div class="text-blue-300 font-semibold py-2">Mon</div>
                    <div class="text-blue-300 font-semibold py-2">Tue</div>
                    <div class="text-blue-300 font-semibold py-2">Wed</div>
                    <div class="text-blue-300 font-semibold py-2">Thu</div>
                    <div class="text-blue-300 font-semibold py-2">Fri</div>
                    <div class="text-blue-300 font-semibold py-2">Sat</div>
                    <!-- Calendar days would be generated here -->
                    @for($i = 1; $i <= 31; $i++)
                        <div class="glass-card p-2 rounded-lg text-white hover:bg-white hover:bg-opacity-10 cursor-pointer">
                            {{ $i }}
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        
        <!-- Leave Requests Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">
                            <input type="checkbox" class="mr-2" onchange="toggleSelectAll(this)">
                        </th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Employee</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Leave Type</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Start Date</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">End Date</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Days</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Reason</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Status</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition-colors">
                        <td class="py-3 px-4">
                            <input type="checkbox" class="leave-checkbox" data-id="1">
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">JS</span>
                                </div>
                                <div>
                                    <p class="text-white font-medium">John Smith</p>
                                    <p class="text-blue-300 text-xs">EMP0001</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-blue-300">Annual Leave</td>
                        <td class="py-3 px-4 text-blue-300">Dec 15, 2024</td>
                        <td class="py-3 px-4 text-blue-300">Dec 20, 2024</td>
                        <td class="py-3 px-4 text-white">5</td>
                        <td class="py-3 px-4 text-blue-300 text-sm">Family vacation</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-500 bg-opacity-20 text-yellow-400">
                                Pending
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button onclick="viewLeaveRequest(1)" class="text-blue-400 hover:text-blue-300 transition-colors" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="approveLeave(1)" class="text-green-400 hover:text-green-300 transition-colors" title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button onclick="rejectLeave(1)" class="text-red-400 hover:text-red-300 transition-colors" title="Reject">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button onclick="commentLeave(1)" class="text-yellow-400 hover:text-yellow-300 transition-colors" title="Comment">
                                    <i class="fas fa-comment"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition-colors">
                        <td class="py-3 px-4">
                            <input type="checkbox" class="leave-checkbox" data-id="2">
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">SJ</span>
                                </div>
                                <div>
                                    <p class="text-white font-medium">Sarah Johnson</p>
                                    <p class="text-blue-300 text-xs">EMP0002</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-blue-300">Sick Leave</td>
                        <td class="py-3 px-4 text-blue-300">Dec 10, 2024</td>
                        <td class="py-3 px-4 text-blue-300">Dec 11, 2024</td>
                        <td class="py-3 px-4 text-white">2</td>
                        <td class="py-3 px-4 text-blue-300 text-sm">Medical appointment</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                Approved
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <button onclick="viewLeaveRequest(2)" class="text-blue-400 hover:text-blue-300 transition-colors" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="downloadDocument(2)" class="text-purple-400 hover:text-purple-300 transition-colors" title="Download Document">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Bulk Actions -->
        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-700">
            <div class="flex items-center space-x-4">
                <button onclick="bulkApproveLeave()" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-check mr-2"></i>Approve Selected
                </button>
                <button onclick="bulkRejectLeave()" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-times mr-2"></i>Reject Selected
                </button>
                <button onclick="bulkExportLeave()" class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                    <i class="fas fa-download mr-2"></i>Export Selected
                </button>
            </div>
            <div class="text-blue-300 text-sm">
                <span id="selected-count">0</span> requests selected
            </div>
        </div>
    </div>
    
    <!-- Leave Request Modal -->
    <div id="requestLeaveModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="glass-card p-6 rounded-xl max-w-md w-full mx-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-white">Request Leave</h3>
                <button onclick="closeModal('requestLeaveModal')" class="text-gray-400 hover:text-gray-300">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form onsubmit="submitLeaveRequest(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Leave Type</label>
                        <select class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                            <option value="annual">Annual Leave</option>
                            <option value="sick">Sick Leave</option>
                            <option value="personal">Personal Leave</option>
                            <option value="maternity">Maternity Leave</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Start Date</label>
                            <input type="date" required class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">End Date</label>
                            <input type="date" required class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Reason</label>
                        <textarea required class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none" rows="3"></textarea>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Supporting Document (Optional)</label>
                        <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeModal('requestLeaveModal')" class="bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                            Submit Request
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- View Leave Request Details Modal -->
    <div id="viewLeaveModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="glass-card p-6 rounded-xl max-w-3xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Leave Request Details</h3>
                <div class="flex items-center space-x-2">
                    <button onclick="editLeaveFromView()" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </button>
                    <button onclick="closeModal('viewLeaveModal')" class="text-gray-400 hover:text-gray-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Request Overview -->
                <div class="lg:col-span-1">
                    <div class="glass-card p-6 rounded-xl">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-lg font-bold" id="viewLeaveEmployeeInitials">JS</span>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold" id="viewLeaveEmployeeName">John Smith</h4>
                                <p class="text-blue-300 text-sm" id="viewLeaveEmployeeId">EMP0001</p>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Leave Type</label>
                                <p class="text-white font-medium" id="viewLeaveType">Annual Leave</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Status</label>
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-500 bg-opacity-20 text-yellow-400" id="viewLeaveStatus">Pending</span>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Duration</label>
                                <p class="text-white" id="viewLeaveDuration">5 days</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Requested On</label>
                                <p class="text-white" id="viewLeaveRequestedDate">Dec 10, 2024</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="glass-card p-4 rounded-xl mt-4">
                        <h5 class="text-white font-semibold mb-3">Quick Actions</h5>
                        <div class="space-y-2">
                            <button onclick="approveLeaveFromView()" class="w-full glass-card p-3 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                                <i class="fas fa-check text-green-400 mr-2"></i>
                                <span class="text-white">Approve Request</span>
                            </button>
                            <button onclick="rejectLeaveFromView()" class="w-full glass-card p-3 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                                <i class="fas fa-times text-red-400 mr-2"></i>
                                <span class="text-white">Reject Request</span>
                            </button>
                            <button onclick="commentLeaveFromView()" class="w-full glass-card p-3 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                                <i class="fas fa-comment text-yellow-400 mr-2"></i>
                                <span class="text-white">Add Comment</span>
                            </button>
                            <button onclick="downloadDocumentFromView()" class="w-full glass-card p-3 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                                <i class="fas fa-download text-purple-400 mr-2"></i>
                                <span class="text-white">Download Document</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Details Section -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Leave Period -->
                    <div class="glass-card p-6 rounded-xl">
                        <h5 class="text-white font-semibold mb-4">Leave Period</h5>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Start Date</label>
                                <p class="text-white text-lg" id="viewLeaveStartDate">Dec 15, 2024</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">End Date</label>
                                <p class="text-white text-lg" id="viewLeaveEndDate">Dec 20, 2024</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center space-x-2 text-blue-300">
                                <i class="fas fa-calendar-alt"></i>
                                <span id="viewLeaveDatesRange">Monday, Dec 15 - Friday, Dec 20, 2024</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reason and Details -->
                    <div class="glass-card p-6 rounded-xl">
                        <h5 class="text-white font-semibold mb-4">Reason & Details</h5>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Reason for Leave</label>
                                <p class="text-white" id="viewLeaveReason">Family vacation to visit relatives in another state. Need to travel and spend quality time with family during the holiday season.</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Additional Notes</label>
                                <p class="text-white" id="viewLeaveNotes">Will be available via email for urgent matters. Emergency contact: Jane Smith (sister) - +1 234 567 8901</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Supporting Documents -->
                    <div class="glass-card p-6 rounded-xl">
                        <h5 class="text-white font-semibold mb-4">Supporting Documents</h5>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 glass-effect rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-file-pdf text-red-400"></i>
                                    <div>
                                        <p class="text-white">travel_itinerary.pdf</p>
                                        <p class="text-gray-400 text-xs">2.3 MB</p>
                                    </div>
                                </div>
                                <button onclick="downloadDocument('travel_itinerary')" class="text-blue-400 hover:text-blue-300">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                            <div class="flex items-center justify-between p-3 glass-effect rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-file-image text-green-400"></i>
                                    <div>
                                        <p class="text-white">booking_confirmation.jpg</p>
                                        <p class="text-gray-400 text-xs">1.1 MB</p>
                                    </div>
                                </div>
                                <button onclick="downloadDocument('booking_confirmation')" class="text-blue-400 hover:text-blue-300">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Approval History -->
                    <div class="glass-card p-6 rounded-xl">
                        <h5 class="text-white font-semibold mb-4">Approval History</h5>
                        <div class="space-y-3">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-blue-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                    <span class="text-blue-400 text-xs font-bold">MJ</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <p class="text-white font-medium">Michael Johnson</p>
                                        <span class="text-gray-400 text-xs">Dec 10, 2024 - 2:30 PM</span>
                                    </div>
                                    <p class="text-gray-300 text-sm">Leave request submitted for review</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-green-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                    <span class="text-green-400 text-xs font-bold">SW</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <p class="text-white font-medium">Sarah Williams (HR)</p>
                                        <span class="text-gray-400 text-xs">Dec 11, 2024 - 9:15 AM</span>
                                    </div>
                                    <p class="text-gray-300 text-sm">Request reviewed and forwarded to department manager</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Leave Request Modal -->
    <div id="editLeaveModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="glass-card p-6 rounded-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-white">Edit Leave Request</h3>
                <button onclick="closeModal('editLeaveModal')" class="text-gray-400 hover:text-gray-300">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form onsubmit="updateLeaveRequest(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Leave Type</label>
                        <select id="editLeaveType" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                            <option value="annual">Annual Leave</option>
                            <option value="sick">Sick Leave</option>
                            <option value="personal">Personal Leave</option>
                            <option value="maternity">Maternity Leave</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Start Date</label>
                            <input type="date" id="editStartDate" required class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">End Date</label>
                            <input type="date" id="editEndDate" required class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Reason</label>
                        <textarea id="editReason" required class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none" rows="3"></textarea>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Additional Notes</label>
                        <textarea id="editNotes" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none" rows="2"></textarea>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Emergency Contact</label>
                        <input type="text" id="editEmergencyContact" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none" placeholder="Name - Phone">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Replace Supporting Document</label>
                        <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeModal('editLeaveModal')" class="bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                            Update Request
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Leave Balance Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-6">Leave Balance Summary</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 glass-effect rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-check text-green-400 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium">Annual Leave</p>
                            <p class="text-blue-300 text-xs">21 days per year</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-white font-bold">15</p>
                        <p class="text-blue-300 text-xs">days left</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-between p-3 glass-effect rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-procedures text-blue-400 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium">Sick Leave</p>
                            <p class="text-blue-300 text-xs">30 days per year</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-white font-bold">28</p>
                        <p class="text-blue-300 text-xs">days left</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-between p-3 glass-effect rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-purple-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-baby text-purple-400 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium">Maternity Leave</p>
                            <p class="text-blue-300 text-xs">90 days</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-white font-bold">90</p>
                        <p class="text-blue-300 text-xs">days available</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-between p-3 glass-effect rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-yellow-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-plane text-yellow-400 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium">Special Leave</p>
                            <p class="text-blue-300 text-xs">5 days per year</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-white font-bold">5</p>
                        <p class="text-blue-300 text-xs">days left</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-6">Leave Calendar</h3>
            <div class="grid grid-cols-7 gap-2 text-center">
                <div class="text-blue-300 text-xs font-semibold">Sun</div>
                <div class="text-blue-300 text-xs font-semibold">Mon</div>
                <div class="text-blue-300 text-xs font-semibold">Tue</div>
                <div class="text-blue-300 text-xs font-semibold">Wed</div>
                <div class="text-blue-300 text-xs font-semibold">Thu</div>
                <div class="text-blue-300 text-xs font-semibold">Fri</div>
                <div class="text-blue-300 text-xs font-semibold">Sat</div>
                
                <!-- Calendar days -->
                @for($day = 1; $day <= 31; $day++)
                    <div class="p-2 text-sm {{ in_array($day, [15, 16, 20, 21, 22, 23, 24]) ? 'bg-yellow-500 bg-opacity-20 text-yellow-400 rounded' : 'text-white hover:bg-white hover:bg-opacity-10 rounded cursor-pointer' }}">
                        {{ $day }}
                    </div>
                @endfor
            </div>
            <div class="mt-4 flex items-center justify-center space-x-6 text-xs">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-yellow-500 bg-opacity-20 rounded"></div>
                    <span class="text-blue-300">Leave Days</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-white bg-opacity-10 rounded"></div>
                    <span class="text-blue-300">Available</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Leave Management Functions
function openRequestLeaveModal() {
    openModal('requestLeaveModal');
}

function submitLeaveRequest(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    
    showNotification('Submitting leave request...', 'info');
    
    setTimeout(() => {
        showNotification('Leave request submitted successfully!', 'success');
        closeModal('requestLeaveModal');
        event.target.reset();
        // In real app, this would refresh the leave requests list
    }, 1500);
}

function viewLeaveRequest(id) {
    // Simulate fetching leave request data
    const leaveData = {
        id: id,
        employeeName: 'John Smith',
        employeeId: 'EMP0001',
        employeeInitials: 'JS',
        leaveType: 'Annual Leave',
        status: 'pending',
        duration: '5 days',
        requestedDate: 'Dec 10, 2024',
        startDate: 'Dec 15, 2024',
        endDate: 'Dec 20, 2024',
        datesRange: 'Monday, Dec 15 - Friday, Dec 20, 2024',
        reason: 'Family vacation to visit relatives in another state. Need to travel and spend quality time with family during the holiday season.',
        notes: 'Will be available via email for urgent matters. Emergency contact: Jane Smith (sister) - +1 234 567 8901',
        documents: [
            { name: 'travel_itinerary.pdf', size: '2.3 MB', type: 'pdf' },
            { name: 'booking_confirmation.jpg', size: '1.1 MB', type: 'image' }
        ]
    };
    
    // Populate view modal with leave data
    document.getElementById('viewLeaveEmployeeInitials').textContent = leaveData.employeeInitials;
    document.getElementById('viewLeaveEmployeeName').textContent = leaveData.employeeName;
    document.getElementById('viewLeaveEmployeeId').textContent = leaveData.employeeId;
    document.getElementById('viewLeaveType').textContent = leaveData.leaveType;
    document.getElementById('viewLeaveStatus').textContent = leaveData.status.charAt(0).toUpperCase() + leaveData.status.slice(1);
    document.getElementById('viewLeaveDuration').textContent = leaveData.duration;
    document.getElementById('viewLeaveRequestedDate').textContent = leaveData.requestedDate;
    document.getElementById('viewLeaveStartDate').textContent = leaveData.startDate;
    document.getElementById('viewLeaveEndDate').textContent = leaveData.endDate;
    document.getElementById('viewLeaveDatesRange').textContent = leaveData.datesRange;
    document.getElementById('viewLeaveReason').textContent = leaveData.reason;
    document.getElementById('viewLeaveNotes').textContent = leaveData.notes;
    
    // Store current leave ID for edit functionality
    window.currentLeaveId = id;
    
    openModal('viewLeaveModal');
    showNotification(`Loading leave request details for #${id}`, 'info');
}

function editLeave(id) {
    // Simulate fetching leave request data for editing
    const leaveData = {
        id: id,
        leaveType: 'annual',
        startDate: '2024-12-15',
        endDate: '2024-12-20',
        reason: 'Family vacation to visit relatives',
        notes: 'Will be available via email for urgent matters',
        emergencyContact: 'Jane Smith - +1 234 567 8901'
    };
    
    // Populate edit modal with leave data
    document.getElementById('editLeaveType').value = leaveData.leaveType;
    document.getElementById('editStartDate').value = leaveData.startDate;
    document.getElementById('editEndDate').value = leaveData.endDate;
    document.getElementById('editReason').value = leaveData.reason;
    document.getElementById('editNotes').value = leaveData.notes;
    document.getElementById('editEmergencyContact').value = leaveData.emergencyContact;
    
    // Store current leave ID
    window.currentLeaveId = id;
    
    openModal('editLeaveModal');
    showNotification(`Loading leave request #${id} for editing`, 'info');
}

function editLeaveFromView() {
    // Close view modal and open edit modal with same leave request
    closeModal('viewLeaveModal');
    editLeave(window.currentLeaveId);
}

function updateLeaveRequest(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    
    showNotification('Updating leave request...', 'info');
    
    setTimeout(() => {
        showNotification(`Leave request #${window.currentLeaveId} updated successfully!`, 'success');
        closeModal('editLeaveModal');
        event.target.reset();
        // In real app, this would refresh the leave requests list
    }, 1500);
}

// Additional view modal functions
function approveLeaveFromView() {
    const leaveId = window.currentLeaveId;
    approveLeave(leaveId);
}

function rejectLeaveFromView() {
    const leaveId = window.currentLeaveId;
    rejectLeave(leaveId);
}

function commentLeaveFromView() {
    const leaveId = window.currentLeaveId;
    commentLeave(leaveId);
}

function downloadDocumentFromView() {
    const leaveId = window.currentLeaveId;
    downloadDocument(leaveId);
}

function downloadDocument(documentName) {
    showNotification(`Downloading ${documentName}...`, 'info');
    setTimeout(() => {
        const link = document.createElement('a');
        link.href = '#';
        link.download = documentName;
        link.click();
        showNotification(`${documentName} downloaded successfully!`, 'success');
    }, 1000);
}

function approveLeave(id) {
    confirmAction('Approve this leave request?', () => {
        showNotification(`Approving leave request #${id}...`, 'info');
        setTimeout(() => {
            showNotification(`Leave request #${id} approved!`, 'success');
            // In real app, this would update the status in the table
        }, 1000);
    });
}

function rejectLeave(id) {
    confirmAction('Reject this leave request?', () => {
        const reason = prompt('Please provide rejection reason:');
        if (reason) {
            showNotification(`Rejecting leave request #${id}...`, 'info');
            setTimeout(() => {
                showNotification(`Leave request #${id} rejected!`, 'success');
                // In real app, this would update the status in the table
            }, 1000);
        }
    });
}

function commentLeave(id) {
    const comment = prompt('Enter your comment:');
    if (comment) {
        showNotification(`Comment added to leave request #${id}`, 'success');
        // In real app, this would save the comment
    }
}

function downloadDocument(id) {
    showNotification(`Downloading document for leave request #${id}...`, 'info');
    // In real app, this would download the actual document
    setTimeout(() => {
        const link = document.createElement('a');
        link.href = '#';
        link.download = `leave_document_${id}.pdf`;
        link.click();
    }, 1000);
}

// Search and Filter Functions
function searchLeaveRequests(searchTerm) {
    if (searchTerm.length > 2) {
        performSearch('employee', searchTerm, 'leave request');
    } else if (searchTerm.length === 0) {
        showNotification('Search cleared', 'info');
    }
}

function filterByStatus(status) {
    if (status) {
        showNotification(`Filtering by status: ${status}`, 'info');
        // In real app, this would filter the table
    } else {
        showNotification('Status filter cleared', 'info');
    }
}

function filterByType(type) {
    if (type) {
        showNotification(`Filtering by type: ${type}`, 'info');
        // In real app, this would filter the table
    } else {
        showNotification('Type filter cleared', 'info');
    }
}

// Calendar View
function toggleCalendarView() {
    const calendarView = document.getElementById('calendarView');
    if (calendarView.classList.contains('hidden')) {
        calendarView.classList.remove('hidden');
        showNotification('Calendar view enabled', 'info');
    } else {
        calendarView.classList.add('hidden');
        showNotification('Calendar view disabled', 'info');
    }
}

// Export Functions
function exportLeaveData() {
    const leaveData = [
        'Employee,Leave Type,Start Date,End Date,Days,Status',
        'John Smith,Annual Leave,Dec 15, 2024,Dec 20, 2024,5,Pending',
        'Sarah Johnson,Sick Leave,Dec 10, 2024,Dec 11, 2024,2,Approved'
    ];
    
    exportData(leaveData, 'leave_requests', 'csv');
}

// Bulk Operations
function bulkApproveLeave() {
    const selectedIds = getSelectedRecords('leave-checkbox');
    if (selectedIds.length > 0) {
        confirmAction(`Approve ${selectedIds.length} selected leave requests?`, () => {
            showNotification(`Approving ${selectedIds.length} leave requests...`, 'info');
            setTimeout(() => {
                showNotification(`${selectedIds.length} leave requests approved!`, 'success');
            }, 2000);
        });
    }
}

function bulkRejectLeave() {
    const selectedIds = getSelectedRecords('leave-checkbox');
    if (selectedIds.length > 0) {
        const reason = prompt('Please provide rejection reason for all selected requests:');
        if (reason) {
            confirmAction(`Reject ${selectedIds.length} selected leave requests?`, () => {
                showNotification(`Rejecting ${selectedIds.length} leave requests...`, 'info');
                setTimeout(() => {
                    showNotification(`${selectedIds.length} leave requests rejected!`, 'success');
                }, 2000);
            });
        }
    }
}

function bulkExportLeave() {
    const selectedIds = getSelectedRecords('leave-checkbox');
    if (selectedIds.length > 0) {
        showNotification(`Exporting ${selectedIds.length} selected leave requests...`, 'info');
        const selectedData = `Employee,Leave Type,Status\nJohn Smith,Annual Leave,Pending\nSarah Johnson,Sick Leave,Approved`;
        exportData(selectedData, 'selected_leave_requests', 'csv');
    }
}

// Initialize checkbox listeners
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.leave-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => updateSelectedCount('leave-checkbox'));
    });
    
    // Initialize selected count
    updateSelectedCount('leave-checkbox');
});
</script>
@endpush
