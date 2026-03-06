@extends('layouts.app')

@section('title', 'Employees')
@section('subtitle', 'Manage all employee records and information')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Total Employees</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['total_employees'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>12% from last month</span>
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
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Active Employees</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['active_employees'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>8% from last month</span>
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
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">New This Month</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['new_employees'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-user-plus mr-1"></i>
                        <span>Recent hires</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-plus text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">On Leave</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $stats['on_leave'] ?? 0 }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-calendar-times mr-1"></i>
                        <span>Currently away</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-times text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Employee Table -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Employee List</h3>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search employees..." class="glass-input px-4 py-2 pr-10 rounded-lg text-white placeholder-blue-200 outline-none w-64" onkeyup="searchEmployees(this.value)">
                    <i class="fas fa-search absolute right-3 top-3 text-blue-300"></i>
                </div>
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none" onchange="filterByDepartment(this.value)">
                    <option value="">All Departments</option>
                    <option value="IT">IT</option>
                    <option value="HR">HR</option>
                    <option value="Finance">Finance</option>
                    <option value="Operations">Operations</option>
                    <option value="Marketing">Marketing</option>
                </select>
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none" onchange="filterByStatus(this.value)">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="on_leave">On Leave</option>
                </select>
                <button onclick="openAddEmployeeModal()" class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                    <i class="fas fa-plus mr-2"></i>Add Employee
                </button>
                <button onclick="importEmployees()" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-upload mr-2"></i>Import
                </button>
                <button onclick="exportEmployees()" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">
                            <input type="checkbox" class="mr-2" onchange="toggleSelectAll(this)">
                        </th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Employee ID</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold cursor-pointer hover:text-blue-200" onclick="sortTable('name')">
                            Name <i class="fas fa-sort text-xs ml-1"></i>
                        </th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold cursor-pointer hover:text-blue-200" onclick="sortTable('department')">
                            Department <i class="fas fa-sort text-xs ml-1"></i>
                        </th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Position</th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold cursor-pointer hover:text-blue-200" onclick="sortTable('status')">
                            Status <i class="fas fa-sort text-xs ml-1"></i>
                        </th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold cursor-pointer hover:text-blue-200" onclick="sortTable('join_date')">
                            Join Date <i class="fas fa-sort text-xs ml-1"></i>
                        </th>
                        <th class="text-left py-3 px-4 text-blue-300 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($employees) && count($employees) > 0)
                        @foreach($employees as $employee)
                        <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition-colors">
                            <td class="py-3 px-4">
                                <input type="checkbox" class="employee-checkbox" data-id="{{ $employee->id }}">
                            </td>
                            <td class="py-3 px-4 text-white">{{ $employee->employee_id ?? 'EMP-' . str_pad($employee->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">{{ strtoupper(substr($employee->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium">{{ $employee->name }}</p>
                                        <p class="text-blue-300 text-xs">{{ $employee->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-blue-300">{{ $employee->department ?? 'Not Assigned' }}</td>
                            <td class="py-3 px-4 text-blue-300">{{ $employee->position ?? 'Not Assigned' }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 text-xs rounded-full {{ $employee->status === 'active' ? 'bg-green-500 bg-opacity-20 text-green-400' : 'bg-red-500 bg-opacity-20 text-red-400' }}">
                                    {{ ucfirst($employee->status ?? 'inactive') }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-blue-300">{{ $employee->join_date ? date('M d, Y', strtotime($employee->join_date)) : 'Not Set' }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-2">
                                    <button onclick="viewEmployee({{ $employee->id }})" class="text-blue-400 hover:text-blue-300 transition-colors" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="editEmployee({{ $employee->id }})" class="text-green-400 hover:text-green-300 transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="viewDocuments({{ $employee->id }})" class="text-yellow-400 hover:text-yellow-300 transition-colors" title="Documents">
                                        <i class="fas fa-file-alt"></i>
                                    </button>
                                    <button onclick="sendEmail({{ $employee->id }})" class="text-purple-400 hover:text-purple-300 transition-colors" title="Send Email">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button onclick="deleteEmployee({{ $employee->id }})" class="text-red-400 hover:text-red-300 transition-colors" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="py-8 text-center text-blue-300">
                                <i class="fas fa-users text-4xl mb-3 opacity-50"></i>
                                <p>No employees found. Add your first employee to get started.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        <!-- Bulk Actions -->
        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-700">
            <div class="flex items-center space-x-4">
                <button onclick="bulkDeleteEmployees()" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-trash mr-2"></i>Delete Selected
                </button>
                <button onclick="bulkExportEmployees()" class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                    <i class="fas fa-download mr-2"></i>Export Selected
                </button>
                <button onclick="bulkSendEmail()" class="bg-purple-500 hover:bg-purple-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-envelope mr-2"></i>Email Selected
                </button>
                <button onclick="bulkUpdateStatus()" class="bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                    <i class="fas fa-user-edit mr-2"></i>Update Status
                </button>
            </div>
            <div class="text-blue-300 text-sm">
                <span id="selected-count">0</span> employees selected
            </div>
        </div>
        
        <!-- Pagination -->
        @if(isset($employees) && method_exists($employees, 'links'))
        <div class="flex items-center justify-between mt-6">
            <p class="text-blue-300 text-sm">
                Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} results
            </p>
            <div class="flex space-x-2">
                {{ $employees->links() }}
            </div>
        </div>
        @endif
    </div>
    
    <!-- Employee Management Modals -->
    <div id="addEmployeeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="glass-card p-6 rounded-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-white">Add New Employee</h3>
                <button onclick="closeModal('addEmployeeModal')" class="text-gray-400 hover:text-gray-300">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form onsubmit="saveEmployee(event)">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">First Name</label>
                        <input type="text" required class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Last Name</label>
                        <input type="text" required class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Email</label>
                        <input type="email" required class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Phone</label>
                        <input type="tel" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Department</label>
                        <select class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                            <option value="">Select Department</option>
                            <option value="IT">IT</option>
                            <option value="HR">HR</option>
                            <option value="Finance">Finance</option>
                            <option value="Operations">Operations</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Position</label>
                        <input type="text" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Join Date</label>
                        <input type="date" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-blue-300 text-sm font-medium mb-2">Status</label>
                        <select class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="on_leave">On Leave</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-6">
                    <button type="button" onclick="closeModal('addEmployeeModal')" class="bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                        Save Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- View Employee Details Modal -->
    <div id="viewEmployeeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="glass-card p-6 rounded-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Employee Details</h3>
                <div class="flex items-center space-x-2">
                    <button onclick="editEmployeeFromView()" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </button>
                    <button onclick="closeModal('viewEmployeeModal')" class="text-gray-400 hover:text-gray-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Profile Section -->
                <div class="lg:col-span-1">
                    <div class="glass-card p-6 rounded-xl text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-3xl font-bold" id="viewEmployeeInitials">JS</span>
                        </div>
                        <h4 class="text-xl font-semibold text-white mb-2" id="viewEmployeeName">John Smith</h4>
                        <p class="text-blue-300 mb-4" id="viewEmployeeId">EMP0001</p>
                        
                        <div class="space-y-3 text-left">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Status:</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400" id="viewEmployeeStatus">Active</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Department:</span>
                                <span class="text-white" id="viewEmployeeDept">IT</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Position:</span>
                                <span class="text-white" id="viewEmployeePos">Software Engineer</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="glass-card p-4 rounded-xl mt-4">
                        <h5 class="text-white font-semibold mb-3">Quick Actions</h5>
                        <div class="space-y-2">
                            <button onclick="sendEmailFromView()" class="w-full glass-card p-3 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                                <i class="fas fa-envelope text-purple-400 mr-2"></i>
                                <span class="text-white">Send Email</span>
                            </button>
                            <button onclick="viewDocumentsFromView()" class="w-full glass-card p-3 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                                <i class="fas fa-file-alt text-yellow-400 mr-2"></i>
                                <span class="text-white">View Documents</span>
                            </button>
                            <button onclick="viewAttendanceFromView()" class="w-full glass-card p-3 rounded-lg text-left hover:bg-white hover:bg-opacity-10 transition-all">
                                <i class="fas fa-clock text-blue-400 mr-2"></i>
                                <span class="text-white">View Attendance</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Details Section -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Personal Information -->
                    <div class="glass-card p-6 rounded-xl">
                        <h5 class="text-white font-semibold mb-4">Personal Information</h5>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Email</label>
                                <p class="text-white" id="viewEmployeeEmail">john.smith@company.com</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Phone</label>
                                <p class="text-white" id="viewEmployeePhone">+1 234 567 8900</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Date of Birth</label>
                                <p class="text-white" id="viewEmployeeDOB">Jan 15, 1990</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Join Date</label>
                                <p class="text-white" id="viewEmployeeJoinDate">Jan 15, 2023</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Address</label>
                                <p class="text-white" id="viewEmployeeAddress">123 Main St, City, State</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Emergency Contact</label>
                                <p class="text-white" id="viewEmployeeEmergency">Jane Smith - +1 234 567 8901</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Employment Information -->
                    <div class="glass-card p-6 rounded-xl">
                        <h5 class="text-white font-semibold mb-4">Employment Information</h5>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Employee Type</label>
                                <p class="text-white">Full-time</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Work Schedule</label>
                                <p class="text-white">Monday - Friday, 9:00 AM - 5:00 PM</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Salary</label>
                                <p class="text-white">$75,000 per year</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">Manager</label>
                                <p class="text-white">Michael Johnson</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Statistics -->
                    <div class="glass-card p-6 rounded-xl">
                        <h5 class="text-white font-semibold mb-4">Statistics</h5>
                        <div class="grid grid-cols-4 gap-4 text-center">
                            <div>
                                <p class="text-2xl font-bold text-green-400">245</p>
                                <p class="text-gray-400 text-sm">Days Present</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-yellow-400">8</p>
                                <p class="text-gray-400 text-sm">Days Late</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-blue-400">15</p>
                                <p class="text-gray-400 text-sm">Leave Days</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-purple-400">4.5</p>
                                <p class="text-gray-400 text-sm">Avg Rating</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Employee Modal -->
    <div id="editEmployeeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="glass-card p-6 rounded-xl max-w-3xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-white">Edit Employee</h3>
                <button onclick="closeModal('editEmployeeModal')" class="text-gray-400 hover:text-gray-300">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form onsubmit="updateEmployee(event)">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="space-y-4">
                        <h5 class="text-white font-semibold border-b border-gray-700 pb-2">Personal Information</h5>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-blue-300 text-sm font-medium mb-2">First Name</label>
                                <input type="text" id="editFirstName" required class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                            </div>
                            <div>
                                <label class="block text-blue-300 text-sm font-medium mb-2">Last Name</label>
                                <input type="text" id="editLastName" required class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                            </div>
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Email</label>
                            <input type="email" id="editEmail" required class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Phone</label>
                            <input type="tel" id="editPhone" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Date of Birth</label>
                            <input type="date" id="editDOB" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Address</label>
                            <textarea id="editAddress" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none" rows="2"></textarea>
                        </div>
                    </div>
                    
                    <!-- Employment Information -->
                    <div class="space-y-4">
                        <h5 class="text-white font-semibold border-b border-gray-700 pb-2">Employment Information</h5>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Department</label>
                            <select id="editDepartment" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                                <option value="IT">IT</option>
                                <option value="HR">HR</option>
                                <option value="Finance">Finance</option>
                                <option value="Operations">Operations</option>
                                <option value="Marketing">Marketing</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Position</label>
                            <input type="text" id="editPosition" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Employee Type</label>
                            <select id="editEmployeeType" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                                <option value="full-time">Full-time</option>
                                <option value="part-time">Part-time</option>
                                <option value="contract">Contract</option>
                                <option value="intern">Intern</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Status</label>
                            <select id="editStatus" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="on_leave">On Leave</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Salary</label>
                            <input type="number" id="editSalary" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-blue-300 text-sm font-medium mb-2">Manager</label>
                            <select id="editManager" class="glass-input w-full px-4 py-2 rounded-lg text-white outline-none">
                                <option value="">Select Manager</option>
                                <option value="1">Michael Johnson</option>
                                <option value="2">Sarah Williams</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-4 mt-6">
                    <button type="button" onclick="closeModal('editEmployeeModal')" class="bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded-lg text-white font-medium transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-white font-medium">
                        Update Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Employee Management Functions
function openAddEmployeeModal() {
    openModal('addEmployeeModal');
}

function saveEmployee(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    
    showNotification('Saving employee...', 'info');
    
    setTimeout(() => {
        showNotification('Employee saved successfully!', 'success');
        closeModal('addEmployeeModal');
        event.target.reset();
        // In real app, this would refresh the employee list
    }, 1500);
}

function viewEmployee(id) {
    // Simulate fetching employee data
    const employeeData = {
        id: id,
        name: 'John Smith',
        email: 'john.smith@company.com',
        phone: '+1 234 567 8900',
        department: 'IT',
        position: 'Software Engineer',
        status: 'active',
        joinDate: 'Jan 15, 2023',
        dob: 'Jan 15, 1990',
        address: '123 Main St, City, State',
        emergency: 'Jane Smith - +1 234 567 8901',
        employeeType: 'full-time',
        salary: 75000,
        manager: 'Michael Johnson'
    };
    
    // Populate view modal with employee data
    document.getElementById('viewEmployeeInitials').textContent = employeeData.name.split(' ').map(n => n[0]).join('');
    document.getElementById('viewEmployeeName').textContent = employeeData.name;
    document.getElementById('viewEmployeeId').textContent = `EMP${String(id).padStart(4, '0')}`;
    document.getElementById('viewEmployeeStatus').textContent = employeeData.status.charAt(0).toUpperCase() + employeeData.status.slice(1);
    document.getElementById('viewEmployeeDept').textContent = employeeData.department;
    document.getElementById('viewEmployeePos').textContent = employeeData.position;
    document.getElementById('viewEmployeeEmail').textContent = employeeData.email;
    document.getElementById('viewEmployeePhone').textContent = employeeData.phone;
    document.getElementById('viewEmployeeDOB').textContent = employeeData.dob;
    document.getElementById('viewEmployeeJoinDate').textContent = employeeData.joinDate;
    document.getElementById('viewEmployeeAddress').textContent = employeeData.address;
    document.getElementById('viewEmployeeEmergency').textContent = employeeData.emergency;
    
    // Store current employee ID for edit functionality
    window.currentEmployeeId = id;
    
    openModal('viewEmployeeModal');
    showNotification(`Loading employee details for #${id}`, 'info');
}

function editEmployee(id) {
    // Simulate fetching employee data for editing
    const employeeData = {
        id: id,
        firstName: 'John',
        lastName: 'Smith',
        email: 'john.smith@company.com',
        phone: '+1 234 567 8900',
        department: 'IT',
        position: 'Software Engineer',
        status: 'active',
        dob: '1990-01-15',
        address: '123 Main St, City, State',
        employeeType: 'full-time',
        salary: 75000,
        manager: '1'
    };
    
    // Populate edit modal with employee data
    document.getElementById('editFirstName').value = employeeData.firstName;
    document.getElementById('editLastName').value = employeeData.lastName;
    document.getElementById('editEmail').value = employeeData.email;
    document.getElementById('editPhone').value = employeeData.phone;
    document.getElementById('editDepartment').value = employeeData.department;
    document.getElementById('editPosition').value = employeeData.position;
    document.getElementById('editStatus').value = employeeData.status;
    document.getElementById('editDOB').value = employeeData.dob;
    document.getElementById('editAddress').value = employeeData.address;
    document.getElementById('editEmployeeType').value = employeeData.employeeType;
    document.getElementById('editSalary').value = employeeData.salary;
    document.getElementById('editManager').value = employeeData.manager;
    
    // Store current employee ID
    window.currentEmployeeId = id;
    
    openModal('editEmployeeModal');
    showNotification(`Loading employee #${id} for editing`, 'info');
}

function editEmployeeFromView() {
    // Close view modal and open edit modal with same employee
    closeModal('viewEmployeeModal');
    editEmployee(window.currentEmployeeId);
}

function updateEmployee(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    
    showNotification('Updating employee information...', 'info');
    
    setTimeout(() => {
        showNotification(`Employee #${window.currentEmployeeId} updated successfully!`, 'success');
        closeModal('editEmployeeModal');
        event.target.reset();
        // In real app, this would refresh the employee list
    }, 1500);
}

// Additional view modal functions
function sendEmailFromView() {
    const employeeId = window.currentEmployeeId;
    sendEmail(employeeId);
}

function viewDocumentsFromView() {
    const employeeId = window.currentEmployeeId;
    viewDocuments(employeeId);
}

function viewAttendanceFromView() {
    const employeeId = window.currentEmployeeId;
    showNotification(`Loading attendance for employee #${employeeId}`, 'info');
    // In real app, this would navigate to attendance filtered by employee
    setTimeout(() => {
        window.location.href = `/attendance?employee=${employeeId}`;
    }, 1000);
}

function deleteEmployee(id) {
    deleteRecord(id, 'employee');
    // In real app, this would remove the row from table
}

function viewDocuments(id) {
    showNotification(`Loading documents for employee #${id}`, 'info');
    // In real app, this would open documents modal
}

function sendEmail(id) {
    showNotification(`Opening email composer for employee #${id}`, 'info');
    // In real app, this would open email modal
}

// Search and Filter Functions
function searchEmployees(searchTerm) {
    if (searchTerm.length > 2) {
        performSearch('name', searchTerm, 'employee');
    } else if (searchTerm.length === 0) {
        // Clear search
        showNotification('Search cleared', 'info');
    }
}

function filterByDepartment(department) {
    if (department) {
        showNotification(`Filtering by department: ${department}`, 'info');
        // In real app, this would filter the table
    } else {
        showNotification('Department filter cleared', 'info');
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

function sortTable(column) {
    showNotification(`Sorting by ${column}`, 'info');
    // In real app, this would sort the table
}

// Import/Export Functions
function importEmployees() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = '.csv,.xlsx,.xls';
    input.onchange = function(e) {
        const file = e.target.files[0];
        if (file) {
            uploadFile(file, 'employees').then(() => {
                showNotification('Employee data imported successfully!', 'success');
            });
        }
    };
    input.click();
}

function exportEmployees() {
    const employeeData = [
        'Employee ID,Name,Email,Department,Position,Status,Join Date',
        'EMP0001,John Smith,john@company.com,IT,Software Engineer,Active,2023-01-15',
        'EMP0002,Sarah Johnson,sarah@company.com,HR,HR Manager,Active,2022-06-20',
        'EMP0003,Michael Brown,michael@company.com,Finance,Accountant,Active,2023-03-10'
    ];
    
    exportData(employeeData, 'employees', 'csv');
}

// Bulk Operations
function bulkDeleteEmployees() {
    bulkDelete('employee', 'employee-checkbox');
}

function bulkExportEmployees() {
    const selectedIds = getSelectedRecords('employee-checkbox');
    if (selectedIds.length > 0) {
        showNotification(`Exporting ${selectedIds.length} selected employees...`, 'info');
        const selectedData = `Employee ID,Name,Email\nEMP0001,John Smith,john@company.com\nEMP0002,Sarah Johnson,sarah@company.com`;
        exportData(selectedData, 'selected_employees', 'csv');
    }
}

function bulkSendEmail() {
    const selectedIds = getSelectedRecords('employee-checkbox');
    if (selectedIds.length > 0) {
        showNotification(`Preparing email for ${selectedIds.length} employees...`, 'info');
        // In real app, this would open bulk email modal
    }
}

function bulkUpdateStatus() {
    const selectedIds = getSelectedRecords('employee-checkbox');
    if (selectedIds.length > 0) {
        showNotification(`Updating status for ${selectedIds.length} employees...`, 'info');
        // In real app, this would open status update modal
    }
}

// Initialize checkbox listeners
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.employee-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => updateSelectedCount('employee-checkbox'));
    });
    
    // Initialize selected count
    updateSelectedCount('employee-checkbox');
});
</script>
@endpush
