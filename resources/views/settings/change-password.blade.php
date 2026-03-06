@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="space-y-6 fade-in">
    <div class="glass-card p-6 rounded-xl max-w-2xl mx-auto">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-white mb-2">Change Password</h2>
            <p class="text-blue-300">Ensure your account is secure with a strong password</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-blue-300 mb-2">Current Password</label>
                <div class="relative">
                    <input type="password" name="current_password" 
                           class="w-full glass-input rounded-lg pr-12" required>
                    <i class="fas fa-lock absolute right-4 top-1/2 text-blue-300"></i>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-blue-300 mb-2">New Password</label>
                    <div class="relative">
                        <input type="password" name="password" 
                               class="w-full glass-input rounded-lg pr-12" required minlength="8">
                        <i class="fas fa-key absolute right-4 top-1/2 text-blue-300"></i>
                    </div>
                    <div class="mt-2">
                        <div class="text-xs text-blue-300">Password strength:</div>
                        <div class="w-full bg-gray-700 rounded-full h-2 mt-1">
                            <div class="bg-gradient-to-r from-red-500 to-yellow-500 h-full rounded-full" style="width: 25%"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-blue-300 mb-2">Confirm New Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" 
                               class="w-full glass-input rounded-lg pr-12" required>
                        <i class="fas fa-check-circle absolute right-4 top-1/2 text-blue-300"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 bg-opacity-50 rounded-lg p-4">
                <h4 class="text-sm font-semibold text-white mb-3">Password Requirements:</h4>
                <div class="space-y-2 text-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-400 mr-3 w-4"></i>
                        <span class="text-gray-300">At least 8 characters</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-400 mr-3 w-4"></i>
                        <span class="text-gray-300">One uppercase letter</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-400 mr-3 w-4"></i>
                        <span class="text-gray-300">One lowercase letter</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-400 mr-3 w-4"></i>
                        <span class="text-gray-300">One number</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-400 mr-3 w-4"></i>
                        <span class="text-gray-300">One special character</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('profile.index') }}" 
                   class="text-blue-300 hover:text-blue-200 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Profile
                </a>
                <button type="submit" 
                        class="bg-gradient-to-r from-orange-500 to-red-600 text-white px-6 py-3 rounded-lg hover:from-orange-600 hover:to-red-700 transition-all duration-300 font-medium">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
