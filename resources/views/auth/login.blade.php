<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Watumishi HR System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary-color: #1a1f2e;
            --primary-light: #2a2f3e;
            --primary-dark: #0f1419;
            --accent-color: #4F46E5;
            --accent-light: #7C3AED;
            --text-primary: #ffffff;
            --text-secondary: #e2e8f0;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.15);
        }
        
        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            min-height: 100vh;
            color: var(--text-primary);
        }
        
        .glass-effect {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        
        .glass-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            backdrop-filter: blur(5px);
            transition: all 0.2s ease;
        }
        
        .glass-input:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent-color);
            box-shadow: 0 0 15px rgba(79, 70, 229, 0.2);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-light) 100%);
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
            font-weight: 600;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .float-animation {
            animation: float 8s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        
    </style>
</head>
<body class="bg-pattern">
    <div class="min-h-screen flex items-center justify-center p-4">
        <!-- Background decoration -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-20 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-30 float-animation"></div>
            <div class="absolute top-40 right-20 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-30 float-animation" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-20 left-1/2 w-72 h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-xl opacity-30 float-animation" style="animation-delay: 4s;"></div>
            <div class="absolute top-1/3 left-1/4 w-96 h-96 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full mix-blend-multiply filter blur-xl opacity-20 float-animation" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-1/3 right-1/4 w-80 h-80 bg-gradient-to-br from-green-500 to-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 float-animation" style="animation-delay: 3s;"></div>
        </div>
        
        <!-- Login Container -->
        <div class="glass-effect rounded-2xl p-8 max-w-md w-full relative z-10 fade-in">
            <!-- Logo Section -->
            <div class="text-center mb-8">
                <div class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Watumishi HR System</h1>
                <p class="text-blue-300 text-sm font-medium">Tanzania Labour Law Compliant HR System</p>
            </div>
            
            <!-- Login Form -->
            <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-blue-300 mb-2">
                        Email Address
                    </label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        autocomplete="email" 
                        required
                        value="{{ old('email') }}"
                        class="glass-input w-full px-4 py-3 rounded-lg text-white placeholder-blue-200 outline-none"
                        placeholder="admin@watumishi.com"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-blue-300 mb-2">
                        Password
                    </label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        autocomplete="current-password" 
                        required
                        class="glass-input w-full px-4 py-3 rounded-lg text-white placeholder-blue-200 outline-none"
                        placeholder="••••••••"
                    >
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            class="rounded border-blue-500 text-blue-600 shadow-sm focus:ring-blue-500 bg-white bg-opacity-10"
                        >
                        <span class="ml-2 text-sm text-blue-300 font-medium">Remember me</span>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="btn-primary w-full py-4 px-4 rounded-xl text-white font-semibold text-lg"
                >
                    Sign In
                </button>
            </form>
        </div>
    </div>
    
    <script>
        // Optimized interactive effects with no delays
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('scale-105');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('scale-105');
                });
                // Remove scale effect on input for better performance
                input.addEventListener('input', function() {
                    this.parentElement.classList.remove('scale-105');
                });
            });
            
            // Optimize form submission
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Signing In...';
                    }
                });
            }
        });
    </script>
</body>
</html>
