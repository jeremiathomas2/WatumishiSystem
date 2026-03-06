@extends('layouts.app')

@section('title', 'Financial Reports')
@section('subtitle', 'Payroll and financial analysis reports')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Financial Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Payroll -->
        <div class="stat-card p-6 rounded-xl border border-green-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-semibold uppercase tracking-wider">Total Payroll</p>
                    <p class="text-4xl font-bold text-white mt-2">${{ number_format($stats['total_payroll'] ?? 0, 2) }}</p>
                    <div class="flex items-center mt-3 text-green-400 text-sm">
                        <i class="fas fa-money-bill mr-1"></i>
                        <span>Monthly total</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-money-bill text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Monthly Expenses -->
        <div class="stat-card p-6 rounded-xl border border-blue-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Monthly Expenses</p>
                    <p class="text-4xl font-bold text-white mt-2">${{ number_format($stats['monthly_expenses'] ?? 0, 2) }}</p>
                    <div class="flex items-center mt-3 text-blue-400 text-sm">
                        <i class="fas fa-receipt mr-1"></i>
                        <span>All expenses</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-receipt text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Employee Costs -->
        <div class="stat-card p-6 rounded-xl border border-purple-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-semibold uppercase tracking-wider">Employee Costs</p>
                    <p class="text-4xl font-bold text-white mt-2">${{ number_format($stats['employee_costs'] ?? 0, 2) }}</p>
                    <div class="flex items-center mt-3 text-purple-400 text-sm">
                        <i class="fas fa-users mr-1"></i>
                        <span>Salaries + benefits</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Benefits Costs -->
        <div class="stat-card p-6 rounded-xl border border-yellow-500 border-opacity-30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-300 text-sm font-semibold uppercase tracking-wider">Benefits Costs</p>
                    <p class="text-4xl font-bold text-white mt-2">${{ number_format($stats['benefits_costs'] ?? 0, 2) }}</p>
                    <div class="flex items-center mt-3 text-yellow-400 text-sm">
                        <i class="fas fa-heart mr-1"></i>
                        <span>Health & insurance</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-heart text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Reports Table -->
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Financial Reports</h3>
            <div class="flex items-center space-x-4">
                <select class="glass-input px-4 py-2 rounded-lg text-white outline-none">
                    <option value="current">Current Month</option>
                    <option value="quarter">This Quarter</option>
                    <option value="year">This Year</option>
                </select>
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                    <i class="fas fa-download mr-2"></i>
                    Export All
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="p-4 text-left text-blue-300">Report Type</th>
                        <th class="p-4 text-left text-blue-300">Period</th>
                        <th class="p-4 text-left text-blue-300">Amount</th>
                        <th class="p-4 text-left text-blue-300">Status</th>
                        <th class="p-4 text-left text-blue-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr class="border-b border-gray-800 hover:bg-gray-800 hover:bg-opacity-50 transition-colors">
                        <td class="p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-file-invoice-dollar text-green-400 text-sm"></i>
                                </div>
                                <span class="text-white font-medium">{{ $report['type'] ?? 'Payroll Report' }}</span>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="text-white">{{ $report['period'] ?? 'December 2023' }}</span>
                        </td>
                        <td class="p-4">
                            <span class="text-white font-medium">${{ number_format($report['amount'] ?? 0, 2) }}</span>
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-600 text-white">
                                {{ $report['status'] ?? 'Completed' }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-400 hover:text-green-300 transition-colors duration-200">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Loading financial reports...
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
