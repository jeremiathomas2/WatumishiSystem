<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Watumishi HR System') - Tanzania Labour Law Compliant HR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        
        /* Light mode variables */
        [data-theme="light"] {
            --primary-color: #f8fafc;
            --primary-light: #f1f5f9;
            --primary-dark: #e2e8f0;
            --accent-color: #4F46E5;
            --accent-light: #7C3AED;
            --text-primary: #1a202c;
            --text-secondary: #2d3748;
            --text-muted: #718096;
            --border-color: rgba(0, 0, 0, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(0, 0, 0, 0.1);
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
        
        /* Ensure sidebar is always visible */
        aside {
            background: rgba(26, 31, 46, 0.95) !important;
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Light mode sidebar */
        [data-theme="light"] aside {
            background: rgba(255, 255, 255, 0.95) !important;
            border-right: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        /* Theme toggle button styles */
        .theme-toggle-btn {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            backdrop-filter: blur(10px) !important;
            transition: all 0.3s ease !important;
        }
        
        .theme-toggle-btn:hover {
            background: rgba(255, 255, 255, 0.2) !important;
            border-color: var(--accent-color) !important;
            transform: scale(1.1) !important;
        }
        
        /* Light mode theme toggle */
        [data-theme="light"] .theme-toggle-btn {
            background: rgba(0, 0, 0, 0.1) !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            color: #1a202c !important;
        }
        
        [data-theme="light"] .theme-toggle-btn:hover {
            background: rgba(0, 0, 0, 0.2) !important;
            border-color: var(--accent-color) !important;
        }
        
        /* Enhanced icon visibility */
        .theme-toggle-btn i {
            transition: all 0.3s ease !important;
        }
        
        [data-theme="light"] .theme-toggle-btn i.fa-moon {
            color: #4a5568 !important;
        }
        
        [data-theme="light"] .theme-toggle-btn i.fa-sun {
            color: #f59e0b !important;
        }
        
        /* Calm colors for all inputs and text elements */
        .glass-input, input[type="text"], input[type="email"], input[type="password"], 
        input[type="number"], input[type="date"], input[type="time"], input[type="search"],
        textarea, select {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            color: #ffffff !important;
            backdrop-filter: blur(5px) !important;
            transition: all 0.3s ease !important;
            border-radius: 8px !important;
            padding: 12px 16px !important;
            outline: none !important;
        }
        
        .glass-input:focus, input:focus, textarea:focus, select:focus {
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(79, 70, 229, 0.5) !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1) !important;
        }
        
        /* Light mode inputs */
        [data-theme="light"] .glass-input, 
        [data-theme="light"] input[type="text"], 
        [data-theme="light"] input[type="email"], 
        [data-theme="light"] input[type="password"], 
        [data-theme="light"] input[type="number"], 
        [data-theme="light"] input[type="date"], 
        [data-theme="light"] input[type="time"], 
        [data-theme="light"] input[type="search"],
        [data-theme="light"] textarea, 
        [data-theme="light"] select {
            background: rgba(0, 0, 0, 0.05) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            color: #1a202c !important;
        }
        
        [data-theme="light"] .glass-input:focus, 
        [data-theme="light"] input:focus, 
        [data-theme="light"] textarea:focus, 
        [data-theme="light"] select:focus {
            background: rgba(0, 0, 0, 0.08) !important;
            border-color: rgba(79, 70, 229, 0.5) !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1) !important;
        }
        
        /* Input placeholders and hints */
        input::placeholder, textarea::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }
        
        [data-theme="light"] input::placeholder, 
        [data-theme="light"] textarea::placeholder {
            color: rgba(0, 0, 0, 0.4) !important;
        }
        
        /* Search inputs specific styling */
        .search-input, input[type="search"] {
            background: rgba(255, 255, 255, 0.06) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            padding-left: 40px !important;
        }
        
        .search-input:focus, input[type="search"]:focus {
            background: rgba(255, 255, 255, 0.1) !important;
            border-color: rgba(79, 70, 229, 0.6) !important;
        }
        
        [data-theme="light"] .search-input, 
        [data-theme="light"] input[type="search"] {
            background: rgba(0, 0, 0, 0.03) !important;
            border: 1px solid rgba(0, 0, 0, 0.08) !important;
        }
        
        [data-theme="light"] .search-input:focus, 
        [data-theme="light"] input[type="search"]:focus {
            background: rgba(0, 0, 0, 0.06) !important;
            border-color: rgba(79, 70, 229, 0.6) !important;
        }
        
        /* Form labels and text hints */
        label, .form-label, .input-label {
            color: #e2e8f0 !important;
            font-weight: 500 !important;
            margin-bottom: 8px !important;
            display: block !important;
        }
        
        [data-theme="light"] label, 
        [data-theme="light"] .form-label, 
        [data-theme="light"] .input-label {
            color: #2d3748 !important;
        }
        
        /* Helper text and validation messages */
        .helper-text, .form-hint, .input-hint {
            color: #94a3b8 !important;
            font-size: 0.875rem !important;
            margin-top: 4px !important;
        }
        
        [data-theme="light"] .helper-text, 
        [data-theme="light"] .form-hint, 
        [data-theme="light"] .input-hint {
            color: #718096 !important;
        }
        
        /* Select dropdowns */
        select option {
            background: #1a1f2e !important;
            color: #ffffff !important;
        }
        
        [data-theme="light"] select option {
            background: #ffffff !important;
            color: #1a202c !important;
        }
        
        /* Buttons with calm colors */
        .btn-primary, .btn-secondary, .btn-success, .btn-danger, .btn-warning, .btn-info {
            transition: all 0.3s ease !important;
            border-radius: 8px !important;
            font-weight: 500 !important;
            padding: 10px 20px !important;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%) !important;
            border: 1px solid rgba(79, 70, 229, 0.3) !important;
            color: #ffffff !important;
        }
        
        .btn-secondary {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: #ffffff !important;
        }
        
        [data-theme="light"] .btn-secondary {
            background: rgba(0, 0, 0, 0.05) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            color: #1a202c !important;
        }
        
        /* Table inputs and search */
        .table-input, .table-search {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
            padding: 6px 12px !important;
            font-size: 0.875rem !important;
        }
        
        [data-theme="light"] .table-input, 
        [data-theme="light"] .table-search {
            background: rgba(0, 0, 0, 0.03) !important;
            border: 1px solid rgba(0, 0, 0, 0.08) !important;
            color: #1a202c !important;
        }
        
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(5px);
            border: 1px solid var(--glass-border);
            transition: all 0.2s ease;
        }
        
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.12);
            transform: translateY(-1px);
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.5);
            border-color: rgba(255, 255, 255, 0.25);
        }
        
        .sidebar-item {
            transition: all 0.2s ease;
            position: relative;
        }
        
        /* Ensure header is completely fixed */
        header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 50 !important;
            transform: translateZ(0) !important;
            will-change: transform;
        }
        
        /* Ensure main content accounts for fixed header */
        main {
            padding-top: 80px !important;
        }
        
        .sidebar-item {
            transition: all 0.2s ease;
            position: relative;
            color: var(--text-secondary);
            font-weight: 500;
        }
        
        .sidebar-item:hover {
            background: rgba(79, 70, 229, 0.15);
            border-left: 4px solid var(--accent-color);
            color: var(--text-primary);
            transform: translateX(1px);
        }
        
        .sidebar-item.active {
            background: rgba(79, 70, 229, 0.2);
            border-left: 4px solid var(--accent-color);
            color: var(--text-primary);
        }
        
        .stat-card {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.15) 0%, rgba(124, 58, 237, 0.15) 100%);
            backdrop-filter: blur(5px);
            border: 1px solid var(--glass-border);
            transition: all 0.2s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.3);
            border-color: rgba(79, 70, 229, 0.3);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-light) 100%);
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
            font-weight: 600;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 25px rgba(79, 70, 229, 0.4);
        }
        
        .notification-badge {
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
            animation: pulse 2s infinite;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            margin-top: 8px;
            margin-left: 16px;
            opacity: 0;
            position: relative;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        
        .dropdown-menu.open {
            max-height: 500px;
            transition: max-height 0.3s ease-in;
            overflow: visible;
            opacity: 1;
            display: block;
            transform: translateY(-2px);
        }
        
        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -6px;
            left: 20px;
            width: 12px;
            height: 12px;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-right: none;
            border-bottom: none;
            transform: rotate(45deg);
            z-index: -1;
        }
        
        .dropdown-arrow {
            transition: transform 0.2s ease;
        }
        
        .dropdown-arrow.rotate {
            transform: rotate(180deg);
        }
        
        .dropdown-menu .sidebar-item {
            display: flex;
            align-items: center;
            color: #e2e8f0;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            opacity: 1;
            cursor: pointer;
            position: relative;
            margin-bottom: 4px;
            padding: 12px 16px !important;
            border: 1px solid transparent;
        }
        
        .dropdown-menu .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            transform: translateX(6px);
            border-color: rgba(79, 70, 229, 0.3);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        }
        
        .dropdown-menu .sidebar-item:active {
            background: rgba(79, 70, 229, 0.25);
            transform: translateX(4px);
            border-color: rgba(79, 70, 229, 0.5);
        }
        
        .user-dropdown {
            position: relative;
            z-index: 999999;
        }
        
        .user-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            min-width: 280px;
            background: rgba(15, 23, 42, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
            z-index: 999999;
            display: none;
            margin-top: 8px;
            overflow: hidden;
        }
        
        .user-dropdown-menu.show {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        .notification-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            min-width: 320px;
            max-height: 400px;
            overflow: hidden;
            transform-origin: top right;
            transition: all 0.2s ease;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
        }
        
        .notification-dropdown.hidden {
            display: none;
        }
        
        .notification-dropdown.fade-in {
            animation: fadeIn 0.2s ease-out;
        }
        
        .notification-dropdown .text-white {
            color: #ffffff !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        .notification-dropdown .text-blue-300 {
            color: #93c5fd !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        .notification-dropdown .text-gray-500 {
            color: #9ca3af !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        .dropdown-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 999998;
            display: none;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(1px);
        }
        
        .dropdown-backdrop.show {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 glass-effect">
            <div class="h-full flex flex-col">
                <!-- Logo -->
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-users text-white text-lg"></i>
                        </div>
                        <div>
                            <h1 class="text-white font-bold text-lg">Watumishi HR</h1>
                            <p class="text-blue-300 text-xs font-medium">Management System</p>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="flex-1 p-4 space-y-2">
                    <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg">
                        <i class="fas fa-home w-5 text-blue-400"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <!-- Employee Management Dropdown -->
                    <div class="dropdown-container">
                        <button onclick="toggleDropdown('employee-dropdown')" class="sidebar-item w-full flex items-center justify-between p-3 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-users w-5 text-green-400"></i>
                                <span class="font-medium">Employee Management</span>
                            </div>
                            <i class="fas fa-chevron-down dropdown-arrow text-xs" id="employee-dropdown-arrow"></i>
                        </button>
                        <div id="employee-dropdown" class="dropdown-menu space-y-1">
                            <a href="{{ route('employees.index') }}" class="sidebar-item flex items-center space-x-3 text-sm">
                                <i class="fas fa-user-tie w-4 text-blue-300"></i>
                                <span>Employees</span>
                            </a>
                            <a href="{{ route('departments.index') }}" class="sidebar-item flex items-center space-x-3 text-sm">
                                <i class="fas fa-building w-4 text-purple-300"></i>
                                <span>Departments</span>
                            </a>
                            <a href="{{ route('recruitment.index') }}" class="sidebar-item flex items-center space-x-3 text-sm">
                                <i class="fas fa-briefcase w-4 text-yellow-300"></i>
                                <span>Recruitment</span>
                            </a>
                            <a href="{{ route('training.index') }}" class="sidebar-item flex items-center space-x-3 text-sm">
                                <i class="fas fa-graduation-cap w-4 text-green-300"></i>
                                <span>Training</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Operations Dropdown -->
                    <div class="dropdown-container">
                        <button onclick="toggleDropdown('operations-dropdown')" class="sidebar-item w-full flex items-center justify-between p-3 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-cogs w-5 text-orange-400"></i>
                                <span class="font-medium">Operations</span>
                            </div>
                            <i class="fas fa-chevron-down dropdown-arrow text-xs" id="operations-dropdown-arrow"></i>
                        </button>
                        <div id="operations-dropdown" class="dropdown-menu space-y-1">
                            <a href="{{ route('attendance.index') }}" class="sidebar-item flex items-center space-x-3 text-sm">
                                <i class="fas fa-clock w-4 text-blue-300"></i>
                                <span>Attendance</span>
                            </a>
                            <a href="{{ route('leave.index') }}" class="sidebar-item flex items-center space-x-3 text-sm">
                                <i class="fas fa-calendar-alt w-4 text-green-300"></i>
                                <span>Leave Management</span>
                            </a>
                            <a href="{{ route('payroll.index') }}" class="sidebar-item flex items-center space-x-3 text-sm">
                                <i class="fas fa-money-bill w-4 text-yellow-300"></i>
                                <span>Payroll</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Compliance Dropdown -->
                    <div class="dropdown-container">
                        <button onclick="toggleDropdown('compliance-dropdown')" class="sidebar-item w-full flex items-center justify-between p-3 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-shield-alt w-5 text-red-400"></i>
                                <span class="font-medium">Compliance</span>
                            </div>
                            <i class="fas fa-chevron-down dropdown-arrow text-xs" id="compliance-dropdown-arrow"></i>
                        </button>
                        <div id="compliance-dropdown" class="dropdown-menu ml-4 space-y-1">
                            <a href="{{ route('discipline.index') }}" class="sidebar-item flex items-center space-x-3 p-2 rounded-lg text-sm">
                                <i class="fas fa-gavel w-4 text-red-300">
                                    <span class="notification-badge text-xs text-white bg-red-500 rounded-full px-2 py-1 ml-auto">
                                        {{ $stats['open_discipline_cases'] ?? 0 }}
                                    </span>
                                </i>
                                <span>Discipline</span>
                            </a>
                            <a href="{{ route('compliance.index') }}" class="sidebar-item flex items-center space-x-3 p-2 rounded-lg text-sm">
                                <i class="fas fa-balance-scale w-4 text-blue-300"></i>
                                <span>Legal Compliance</span>
                            </a>
                            <a href="{{ route('compliance.policies') }}" class="sidebar-item flex items-center space-x-3 p-2 rounded-lg text-sm">
                                <i class="fas fa-file-contract w-4 text-purple-300"></i>
                                <span>Policies</span>
                            </a>
                            <a href="{{ route('compliance.index') }}" class="sidebar-item flex items-center space-x-3 p-2 rounded-lg text-sm">
                                <i class="fas fa-chart-line w-4 text-green-300"></i>
                                <span>Reports</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- System Dropdown -->
                    <div class="dropdown-container">
                        <button onclick="toggleDropdown('system-dropdown')" class="sidebar-item w-full flex items-center justify-between p-3 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-cogs w-5 text-gray-300"></i>
                                <span class="font-medium">System</span>
                            </div>
                            <i class="fas fa-chevron-down dropdown-arrow text-xs" id="system-dropdown-arrow"></i>
                        </button>
                        <div id="system-dropdown" class="dropdown-menu ml-4 space-y-1">
                            <a href="{{ route('performance.index') }}" class="sidebar-item flex items-center space-x-3 p-2 rounded-lg text-sm">
                                <i class="fas fa-chart-line w-4 text-blue-300"></i>
                                <span>Performance</span>
                            </a>
                            <a href="{{ route('settings.index') }}" class="sidebar-item flex items-center space-x-3 p-2 rounded-lg text-sm">
                                <i class="fas fa-cog w-4 text-gray-300"></i>
                                <span>Settings</span>
                            </a>
                            <a href="#" onclick="showAddReviewModal()" class="sidebar-item flex items-center space-x-3 p-2 rounded-lg text-sm">
                                <i class="fas fa-user-plus w-4 text-green-300"></i>
                                <span>Add Review</span>
                            </a>
                            <a href="#" onclick="showGenerateReportsModal()" class="sidebar-item flex items-center space-x-3 p-2 rounded-lg text-sm">
                                <i class="fas fa-chart-bar w-4 text-purple-300"></i>
                                <span>Generate Reports</span>
                            </a>
                            <a href="{{ route('users.index') }}" class="sidebar-item flex items-center space-x-3 p-2 rounded-lg text-sm">
                                <i class="fas fa-users-cog w-4 text-blue-300"></i>
                                <span>User Management</span>
                            </a>
                            <a href="{{ route('backup.index') }}" class="sidebar-item flex items-center space-x-3 p-2 rounded-lg text-sm">
                                <i class="fas fa-database w-4 text-green-300"></i>
                                <span>Backup & Restore</span>
                            </a>
                            <a href="{{ route('audit.index') }}" class="sidebar-item flex items-center space-x-3 p-2 rounded-lg text-sm">
                                <i class="fas fa-history w-4 text-purple-300"></i>
                                <span>Audit Logs</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Reports Dropdown -->
                    <div class="dropdown-container">
                        <button onclick="toggleDropdown('reports-dropdown')" class="sidebar-item w-full flex items-center justify-between p-3 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-chart-bar w-5 text-purple-400"></i>
                                <span class="font-medium">Reports</span>
                            </div>
                            <i class="fas fa-chevron-down dropdown-arrow text-xs" id="reports-dropdown-arrow"></i>
                        </button>
                        <div id="reports-dropdown" class="dropdown-menu space-y-1">
                            <a href="{{ route('reports.index') }}" class="sidebar-item flex items-center space-x-3 text-sm">
                                <i class="fas fa-file-alt w-4 text-blue-300"></i>
                                <span>General Reports</span>
                            </a>
                            <a href="{{ route('reports.financial') }}" class="sidebar-item flex items-center space-x-3 text-sm">
                                <i class="fas fa-dollar-sign w-4 text-green-300"></i>
                                <span>Financial Reports</span>
                            </a>
                            <a href="{{ route('reports.attendance') }}" class="sidebar-item flex items-center space-x-3 text-sm">
                                <i class="fas fa-user-clock w-4 text-purple-300"></i>
                                <span>Attendance Reports</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </aside>
        
        <!-- Content Container - After Left Menu -->
        <div class="flex-1 flex flex-col overflow-auto">
            <!-- Top Bar -->
            <header class="glass-effect border-b border-gray-700 fixed top-0 left-64 right-0 z-50 backdrop-blur-md" style="position: fixed !important; transform: translateZ(0) !important; left: 256px !important;">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-white">@yield('title', 'Dashboard')</h1>
                        <p class="text-blue-300 text-sm font-medium">@yield('subtitle', 'Welcome to Watumishi HR System')</p>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <!-- Notifications -->
                        <div class="relative">
                            <button onclick="toggleNotificationDropdown()" class="relative text-gray-300 hover:text-white transition-all hover:scale-110 p-2">
                                <i class="fas fa-bell text-xl"></i>
                                <span id="notification-badge" class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                            </button>
                            
                            <!-- Notification Dropdown -->
                            <div id="notification-dropdown" class="notification-dropdown absolute right-0 mt-2 w-80 rounded-xl shadow-2xl border border-gray-700 hidden z-[60]">
                                <div class="p-4 border-b border-gray-700">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-white font-semibold">Notifications</h3>
                                        <div class="flex items-center space-x-2">
                                            <button onclick="markAllNotificationsRead()" class="text-blue-400 hover:text-blue-300 text-sm">
                                                Mark all read
                                            </button>
                                            <a href="{{ route('notifications.index') }}" class="text-purple-400 hover:text-purple-300 text-sm">
                                                View all
                                            </a>
                                            <button onclick="toggleNotificationDropdown()" class="text-gray-400 hover:text-gray-300 transition-colors" title="Close">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="notification-list" class="max-h-96 overflow-y-auto">
                                    <!-- Notifications will be loaded here -->
                                </div>
                            </div>
                        </div>
                        
                        <!-- User Profile Dropdown -->
                        <div class="user-dropdown">
                            <button onclick="toggleUserDropdown()" class="flex items-center space-x-3 text-gray-300 hover:text-white transition-all hover:scale-110 p-2 rounded-lg">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center overflow-hidden">
                                    @if(Auth::user()->profile_photo)
                                        <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" 
                                             alt="Profile Photo" class="w-full h-full object-cover">
                                    @else
                                        <i class="fas fa-user text-white text-lg"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-white font-medium">{{ Auth::user()->name }}</p>
                                    <p class="text-blue-300 text-xs">{{ Auth::user()->email }}</p>
                                </div>
                            </button>
                        </div>
                        
                        <!-- Theme Toggle -->
                        <button onclick="toggleTheme()" class="theme-toggle-btn text-gray-300 hover:text-white transition-all hover:scale-110 p-2 rounded-lg" title="Toggle Theme">
                            <i id="theme-icon" class="fas fa-moon text-xl"></i>
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <div class="flex-1" style="padding-top: 120px !important; padding-left: 32px !important; padding-right: 32px !important;">
                @yield('content')
            </div>
        </div>
    </div>
    
    @stack('scripts')
    
    <!-- Dropdown Backdrop -->
    <div id="dropdown-backdrop" class="dropdown-backdrop" onclick="closeSidebarDropdowns()"></div>
    
    <!-- User Dropdown moved to body level for maximum z-index -->
    <div id="user-dropdown-menu" class="user-dropdown-menu">
        <div class="p-4 border-b border-gray-600 bg-gradient-to-r from-blue-600 to-purple-600 rounded-t-lg">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center overflow-hidden">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" 
                             alt="Profile Photo" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-user text-white text-lg"></i>
                    @endif
                </div>
                <div>
                    <p class="text-white font-bold">{{ Auth::user()->name }}</p>
                    <p class="text-blue-100 text-sm">{{ Auth::user()->email }}</p>
                    <p class="text-blue-200 text-xs uppercase tracking-wider font-semibold">{{ ucfirst(Auth::user()->role) }}</p>
                </div>
            </div>
        </div>
        <div class="py-2">
            <a href="{{ route('profile.index') }}" class="flex items-center space-x-3 text-gray-300 hover:text-white hover:bg-white hover:bg-opacity-10 px-4 py-3 text-sm transition-all">
                <i class="fas fa-user w-4 text-blue-400"></i>
                <span>My Profile</span>
            </a>
            <a href="{{ route('settings.index') }}" class="flex items-center space-x-3 text-gray-300 hover:text-white hover:bg-white hover:bg-opacity-10 px-4 py-3 text-sm transition-all">
                <i class="fas fa-cog w-4 text-gray-400"></i>
                <span>Account Settings</span>
            </a>
            <a href="{{ route('password.change') }}" class="flex items-center space-x-3 text-gray-300 hover:text-white hover:bg-white hover:bg-opacity-10 px-4 py-3 text-sm transition-all">
                <i class="fas fa-key w-4 text-yellow-400"></i>
                <span>Change Password</span>
            </a>
            <a href="{{ route('notifications.index') }}" class="flex items-center space-x-3 text-gray-300 hover:text-white hover:bg-white hover:bg-opacity-10 px-4 py-3 text-sm transition-all">
                <i class="fas fa-bell w-4 text-purple-400"></i>
                <span>Notifications</span>
                <span class="ml-auto w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
            </a>
        </div>
        <div class="border-t border-gray-600 py-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center space-x-3 text-red-400 hover:text-red-300 hover:bg-red-500 hover:bg-opacity-20 px-4 py-3 text-sm w-full text-left transition-all">
                    <i class="fas fa-sign-out-alt w-4"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
    
    <script>
        // Optimized auto-logout functionality
        let inactivityTimer;
        let countdownTimer;
        let timeRemaining;
        const INACTIVITY_TIMEOUT = 5 * 60 * 1000; // 5 minutes in milliseconds
        const WARNING_TIMEOUT = 30 * 1000; // 30 seconds warning
        
        // Debounced activity handler for better performance
        let activityDebounce;
        function handleActivity() {
            clearTimeout(activityDebounce);
            activityDebounce = setTimeout(resetInactivityTimer, 100);
        }
        
        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            clearTimeout(countdownTimer);
            timeRemaining = INACTIVITY_TIMEOUT;
            updateSessionDisplay();
            startCountdown();
            
            // Set timer to show warning
            inactivityTimer = setTimeout(() => {
                showInactivityWarning();
                // Set final logout timer
                setTimeout(() => {
                    logoutNow();
                }, WARNING_TIMEOUT);
            }, INACTIVITY_TIMEOUT);
        }
        
        function startCountdown() {
            countdownTimer = setInterval(() => {
                timeRemaining -= 1000;
                updateSessionDisplay();
                
                if (timeRemaining <= 0) {
                    clearInterval(countdownTimer);
                }
            }, 1000);
        }
        
        function updateSessionDisplay() {
            const sessionTimeElement = document.getElementById('session-time');
            if (sessionTimeElement) {
                const minutes = Math.floor(timeRemaining / 60000);
                const seconds = Math.floor((timeRemaining % 60000) / 1000);
                
                if (minutes > 0) {
                    sessionTimeElement.textContent = `${minutes}m ${seconds}s`;
                    sessionTimeElement.className = 'text-yellow-400';
                } else {
                    sessionTimeElement.textContent = `${seconds}s`;
                    sessionTimeElement.className = 'text-red-400 font-bold animate-pulse';
                }
                
                // Add warning when less than 1 minute
                if (timeRemaining < 60000) {
                    sessionTimeElement.parentElement.classList.add('animate-pulse');
                } else {
                    sessionTimeElement.parentElement.classList.remove('animate-pulse');
                }
            }
        }
        
        function showInactivityWarning() {
            // Show warning modal
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 fade-in';
            modal.innerHTML = `
                <div class="glass-effect rounded-2xl p-8 max-w-md w-full mx-4 transform scale-100 transition-all">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-6 bg-red-500 bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-400 text-3xl animate-pulse"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Session Timeout Warning</h3>
                        <p class="text-blue-300 mb-6">Your session will expire in 30 seconds due to inactivity. Would you like to extend your session?</p>
                        <div class="flex space-x-4">
                            <button onclick="stayLoggedIn()" class="btn-primary flex-1 py-3 px-4 rounded-lg text-white font-semibold">
                                Stay Logged In
                            </button>
                            <button onclick="logoutNow()" class="bg-red-500 hover:bg-red-600 flex-1 py-3 px-4 rounded-lg text-white font-semibold transition-colors">
                                Logout Now
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }
        
        function stayLoggedIn() {
            // Remove warning modal
            const modal = document.querySelector('.fixed.inset-0');
            if (modal) {
                modal.remove();
            }
            
            // Reset timer
            resetInactivityTimer();
            
            // Show confirmation
            showNotification('Session extended for 5 minutes', 'success');
        }
        
        function logoutNow() {
            // Remove warning modal if exists
            const modal = document.querySelector('.fixed.inset-0');
            if (modal) {
                modal.remove();
            }
            
            // Show notification
            showNotification('Logging out due to inactivity...', 'info');
            
            // Create and submit a form for POST logout
            setTimeout(() => {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("logout") }}';
                
                // Add CSRF token
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);
                
                document.body.appendChild(form);
                form.submit();
            }, 1000);
        }
        
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg glass-effect z-50 fade-in`;
            
            const colors = {
                success: 'bg-green-500 bg-opacity-20 border-green-500',
                info: 'bg-blue-500 bg-opacity-20 border-blue-500',
                warning: 'bg-yellow-500 bg-opacity-20 border-yellow-500',
                error: 'bg-red-500 bg-opacity-20 border-red-500'
            };
            
            notification.classList.add(...colors[type].split(' '));
            notification.innerHTML = `
                <div class="flex items-center space-x-3">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} text-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-400"></i>
                    <span class="text-white font-medium">${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Remove notification after 3 seconds
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    notification.remove();
                }
            }, 3000);
        }
        
        // Optimized initialization with throttled activity tracking
        document.addEventListener('DOMContentLoaded', function() {
            resetInactivityTimer();
            
            // Throttled activity tracking for better performance
            let throttleTimer;
            function throttledActivity() {
                if (!throttleTimer) {
                    throttleTimer = setTimeout(() => {
                        handleActivity();
                        throttleTimer = null;
                    }, 50);
                }
            }
            
            // Track user activity with optimized event handling
            const activityEvents = [
                'mousedown', 'keypress', 'scroll', 'touchstart', 'click'
            ];
            
            activityEvents.forEach(event => {
                document.addEventListener(event, throttledActivity, { passive: true, capture: true });
            });
            
            // Separate handler for mousemove with higher throttle
            let mouseMoveThrottle;
            document.addEventListener('mousemove', () => {
                if (!mouseMoveThrottle) {
                    mouseMoveThrottle = setTimeout(() => {
                        handleActivity();
                        mouseMoveThrottle = null;
                    }, 200);
                }
            }, { passive: true, capture: true });
        });
        
        // Optimized dropdown functions
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const arrow = document.getElementById(dropdownId + '-arrow');
            
            if (!dropdown || !arrow) return;
            
            // Close all other dropdowns efficiently
            const allDropdowns = document.querySelectorAll('.dropdown-menu');
            const allArrows = document.querySelectorAll('.dropdown-arrow');
            
            allDropdowns.forEach(menu => {
                if (menu.id !== dropdownId && menu.classList.contains('open')) {
                    menu.classList.remove('open');
                    menu.style.opacity = '0';
                }
            });
            
            allArrows.forEach(arrowElement => {
                if (arrowElement.id !== dropdownId + '-arrow' && arrowElement.classList.contains('rotate')) {
                    arrowElement.classList.remove('rotate');
                }
            });
            
            // Toggle current dropdown
            const isOpen = dropdown.classList.contains('open');
            if (isOpen) {
                dropdown.classList.remove('open');
                dropdown.style.opacity = '0';
                arrow.classList.remove('rotate');
            } else {
                dropdown.classList.add('open');
                dropdown.style.opacity = '1';
                arrow.classList.add('rotate');
            }
        }
        
        // Prevent dropdown from closing when clicking on its own items
        document.addEventListener('click', function(event) {
            const dropdownItem = event.target.closest('.sidebar-item');
            if (dropdownItem) {
                event.stopPropagation();
            }
        });
        
        // Optimized user dropdown with better positioning
        function toggleUserDropdown() {
            const dropdown = document.getElementById('user-dropdown-menu');
            const backdrop = document.getElementById('dropdown-backdrop');
            const userButton = document.querySelector('.user-dropdown button');
            
            if (!dropdown || !backdrop || !userButton) return;
            
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
                backdrop.classList.remove('show');
            } else {
                // Efficient positioning calculation
                const buttonRect = userButton.getBoundingClientRect();
                
                dropdown.style.position = 'fixed';
                dropdown.style.top = (buttonRect.bottom + 8) + 'px';
                dropdown.style.left = (buttonRect.left) + 'px';
                dropdown.style.width = buttonRect.width + 'px';
                dropdown.style.zIndex = '999999';
                
                dropdown.classList.add('show');
                backdrop.classList.add('show');
            }
        }
        
        // Optimized close all dropdowns
        function closeSidebarDropdowns() {
            const userDropdown = document.getElementById('user-dropdown-menu');
            const backdrop = document.getElementById('dropdown-backdrop');
            const allDropdowns = document.querySelectorAll('.dropdown-menu');
            const allArrows = document.querySelectorAll('.dropdown-arrow');
            
            if (userDropdown) userDropdown.classList.remove('show');
            if (backdrop) backdrop.classList.remove('show');
            
            allDropdowns.forEach(menu => menu.classList.remove('open'));
            allArrows.forEach(arrow => arrow.classList.remove('rotate'));
        }
        
        // Close user dropdown when clicking outside (but not on backdrop)
        document.addEventListener('click', function(event) {
            const userDropdown = document.getElementById('user-dropdown-menu');
            const userButton = event.target.closest('.user-dropdown');
            const backdrop = event.target.closest('#dropdown-backdrop');
            
            if (!userButton && !backdrop && userDropdown.classList.contains('show')) {
                closeSidebarDropdowns();
            }
        });
        
        // Close sidebar dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const dropdownContainers = document.querySelectorAll('.dropdown-container');
            
            dropdownContainers.forEach(container => {
                if (!container.contains(event.target)) {
                    const dropdown = container.querySelector('.dropdown-menu');
                    const arrow = container.querySelector('.dropdown-arrow');
                    if (dropdown) dropdown.classList.remove('open');
                    if (arrow) arrow.classList.remove('rotate');
                }
            });
        });
        
        // Close dropdowns on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeAllDropdowns();
            }
        });
        
        // Theme toggle functionality
        function toggleTheme() {
            const html = document.documentElement;
            const themeIcon = document.getElementById('theme-icon');
            const currentTheme = html.getAttribute('data-theme');
            
            if (currentTheme === 'light') {
                html.removeAttribute('data-theme');
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
                localStorage.setItem('theme', 'dark');
            } else {
                html.setAttribute('data-theme', 'light');
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
                localStorage.setItem('theme', 'light');
            }
        }
        
        // Global CRUD and Utility Functions
        window.showNotification = function(message, type = 'info', duration = 5000) {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(notification => notification.remove());
            
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification fixed top-4 right-4 p-4 rounded-lg text-white font-medium z-50 shadow-lg transition-all duration-300 ${
                type === 'success' ? 'bg-green-500' :
                type === 'error' ? 'bg-red-500' :
                type === 'warning' ? 'bg-yellow-500' :
                'bg-blue-500'
            }`;
            notification.innerHTML = `
                <div class="flex items-center space-x-3">
                    <i class="fas ${
                        type === 'success' ? 'fa-check-circle' :
                        type === 'error' ? 'fa-exclamation-triangle' :
                        type === 'warning' ? 'fa-exclamation-triangle' :
                        'fa-info-circle'
                    }"></i>
                    <span>${message}</span>
                    <button onclick="this.parentElement.remove()" class="ml-4 text-gray-300 hover:text-gray-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            // Add to page
            document.body.appendChild(notification);
            
            // Auto remove after specified duration
            setTimeout(() => {
                notification.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    if (notification.parentNode) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, duration);
        };

        window.openModal = function(modalId, title = 'Modal', content = '') {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                
                // Update modal title if provided
                const titleElement = modal.querySelector('h3');
                if (titleElement && title !== 'Modal') {
                    titleElement.textContent = title;
                }
                
                // Update modal content if provided
                const contentElement = modal.querySelector('.modal-content');
                if (contentElement && content) {
                    contentElement.innerHTML = content;
                }
            }
        };

        window.closeModal = function(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        };

        window.confirmAction = function(message, callback) {
            if (confirm(message)) {
                callback();
            }
        };

        // CRUD Operations
        window.viewRecord = function(id, type = 'record') {
            console.log(`Viewing ${type} #${id}`);
            showNotification(`Viewing ${type} #${id}`, 'info');
            return true;
        };

        window.editRecord = function(id, type = 'record', data = null) {
            console.log(`Editing ${type} #${id}`, data);
            showNotification(`Editing ${type} #${id}`, 'info');
            return true;
        };

        window.deleteRecord = function(id, type = 'record') {
            confirmAction(`Are you sure you want to delete this ${type}?`, () => {
                console.log(`Deleting ${type} #${id}`);
                showNotification(`${type} #${id} deleted`, 'success');
                return true;
            });
        };

        window.addRecord = function(type = 'record') {
            console.log(`Adding new ${type}`);
            showNotification(`Adding new ${type}...`, 'info');
            return true;
        };

        // Search Functions
        window.performSearch = function(searchBy, searchTerm, type = 'record') {
            console.log(`Searching ${type}s by ${searchBy}: "${searchTerm}"`);
            showNotification(`Searching ${type}s by ${searchBy}: "${searchTerm}"`, 'info');
            return { searchBy, searchTerm, results: [] };
        };

        // File Operations
        window.uploadFile = function(file, type = 'data') {
            if (file) {
                console.log(`Uploading ${type} file:`, file.name, file.size);
                showNotification(`Uploading ${file.name}...`, 'info');
                
                return new Promise((resolve, reject) => {
                    setTimeout(() => {
                        showNotification(`${file.name} uploaded successfully!`, 'success');
                        resolve({ success: true, file: file.name });
                    }, 2000);
                });
            } else {
                showNotification('Please select a file to upload', 'error');
                return Promise.reject('No file selected');
            }
        };

        window.exportData = function(data, filename = 'export', format = 'csv') {
            console.log(`Exporting ${format} data:`, data);
            showNotification(`Exporting ${filename}.${format}...`, 'info');
            
            // Create download link
            const link = document.createElement('a');
            
            if (format === 'csv') {
                const csvContent = Array.isArray(data) ? data.join('\n') : data;
                link.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvContent);
            } else if (format === 'json') {
                link.href = 'data:application/json;charset=utf-8,' + encodeURIComponent(JSON.stringify(data, null, 2));
            } else if (format === 'pdf') {
                link.href = '#'; // In real app, this would generate PDF
                showNotification('PDF export would require server-side generation', 'warning');
            }
            
            link.download = `${filename}.${format}`;
            link.click();
            
            showNotification(`${filename}.${format} exported successfully!`, 'success');
            return true;
        };

        // Backup Functions
        window.createBackup = function(type = 'full', dateRange = null) {
            console.log(`Creating ${type} backup:`, dateRange);
            showNotification(`Creating ${type} backup...`, 'info');
            
            return new Promise((resolve) => {
                setTimeout(() => {
                    const backupName = `backup_${type}_${new Date().toISOString().split('T')[0]}`;
                    showNotification(`${backupName} created successfully!`, 'success');
                    resolve({ success: true, filename: backupName });
                }, 3000);
            });
        };

        window.restoreData = function(backupFile) {
            if (backupFile) {
                console.log('Restoring from backup:', backupFile.name);
                showNotification(`Restoring from ${backupFile.name}...`, 'info');
                
                return new Promise((resolve, reject) => {
                    setTimeout(() => {
                        showNotification('Data restored successfully!', 'success');
                        resolve({ success: true, restored: backupFile.name });
                    }, 2500);
                });
            } else {
                showNotification('Please select a backup file to restore', 'error');
                return Promise.reject('No backup file selected');
            }
        };

        // Bulk Operations
        window.selectAllRecords = function(checkboxName = 'record-checkbox') {
            const checkboxes = document.querySelectorAll(`.${checkboxName}`);
            checkboxes.forEach(cb => cb.checked = true);
            updateSelectedCount(checkboxName);
        };

        window.deselectAllRecords = function(checkboxName = 'record-checkbox') {
            const checkboxes = document.querySelectorAll(`.${checkboxName}`);
            checkboxes.forEach(cb => cb.checked = false);
            updateSelectedCount(checkboxName);
        };

        window.getSelectedRecords = function(checkboxName = 'record-checkbox') {
            const checkboxes = document.querySelectorAll(`.${checkboxName}:checked`);
            return Array.from(checkboxes).map(cb => cb.dataset.id || cb.value);
        };

        window.updateSelectedCount = function(checkboxName = 'record-checkbox') {
            const checkedBoxes = document.querySelectorAll(`.${checkboxName}:checked`);
            const count = checkedBoxes.length;
            const countElement = document.getElementById('selected-count');
            if (countElement) {
                countElement.textContent = count;
            }
            return count;
        };

        window.bulkDelete = function(type = 'record', checkboxName = 'record-checkbox') {
            const selectedIds = getSelectedRecords(checkboxName);
            
            if (selectedIds.length === 0) {
                showNotification(`Please select ${type}s to delete`, 'error');
                return false;
            }
            
            confirmAction(`Are you sure you want to delete ${selectedIds.length} ${type}(s)?`, () => {
                console.log(`Bulk deleting ${type}s:`, selectedIds);
                showNotification(`Deleting ${selectedIds.length} ${type}(s)...`, 'info');
                
                return new Promise((resolve) => {
                    setTimeout(() => {
                        showNotification(`${selectedIds.length} ${type}(s) deleted successfully!`, 'success');
                        resolve({ success: true, deleted: selectedIds.length });
                    }, 2000);
                });
            });
        };

        window.bulkExport = function(data, type = 'record', checkboxName = 'record-checkbox', filename = 'export') {
            const selectedIds = getSelectedRecords(checkboxName);
            
            if (selectedIds.length === 0) {
                showNotification(`Please select ${type}s to export`, 'error');
                return false;
            }
            
            const selectedData = data.filter(item => selectedIds.includes(item.id));
            return exportData(selectedData, filename);
        };

        // Utility Functions
        window.formatDate = function(date) {
            return new Date(date).toLocaleDateString();
        };

        window.formatFileSize = function(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        };

        window.validateForm = function(formElement) {
            const inputs = formElement.querySelectorAll('input[required], select[required], textarea[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                } else {
                    input.classList.remove('border-red-500');
                }
            });
            
            return isValid;
        };

        // Initialize global event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all checkbox listeners
            const checkboxes = document.querySelectorAll('[class*="checkbox"]');
            checkboxes.forEach(checkbox => {
                if (checkbox.classList.contains('record-checkbox')) {
                    checkbox.addEventListener('change', () => updateSelectedCount('record-checkbox'));
                }
            });
            
            // Initialize modal close buttons
            const closeButtons = document.querySelectorAll('[onclick*="closeModal"]');
            closeButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                });
            });
            
            console.log('Global CRUD and utility functions initialized');
        });
        
        // Load saved theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            const themeIcon = document.getElementById('theme-icon');
            
            if (savedTheme === 'light') {
                document.documentElement.setAttribute('data-theme', 'light');
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                // Default to dark mode
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
            
            // Initialize notifications
            loadNotifications();
            updateNotificationBadge();
        });

        // Notification Functions
        function toggleNotificationDropdown() {
            const dropdown = document.getElementById('notification-dropdown');
            const isHidden = dropdown.classList.contains('hidden');
            
            if (isHidden) {
                dropdown.classList.remove('hidden');
                dropdown.classList.add('fade-in');
                loadNotifications();
            } else {
                dropdown.classList.add('hidden');
            }
        }

        function closeAllDropdowns() {
            const dropdowns = document.querySelectorAll('.dropdown-menu');
            dropdowns.forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
            // Close notification dropdown separately
            const notificationDropdown = document.getElementById('notification-dropdown');
            if (notificationDropdown) {
                notificationDropdown.classList.add('hidden');
            }
        }

        function loadNotifications() {
            const notificationList = document.getElementById('notification-list');
            
            // Mock notifications data
            const notifications = [
                {
                    id: 1,
                    type: 'leave_request',
                    title: 'New Leave Request',
                    message: 'John Smith has requested leave from March 10-15, 2024',
                    time: '5 minutes ago',
                    read: false,
                    icon: 'fa-calendar-alt',
                    color: 'blue'
                },
                {
                    id: 2,
                    type: 'performance_review',
                    title: 'Performance Review Due',
                    message: 'Performance review for Sarah Johnson is due this week',
                    time: '1 hour ago',
                    read: false,
                    icon: 'fa-chart-line',
                    color: 'green'
                },
                {
                    id: 3,
                    type: 'attendance_alert',
                    title: 'Attendance Alert',
                    message: 'Michael Brown has been absent for 3 consecutive days',
                    time: '2 hours ago',
                    read: true,
                    icon: 'fa-exclamation-triangle',
                    color: 'yellow'
                },
                {
                    id: 4,
                    type: 'system_update',
                    title: 'System Update',
                    message: 'System maintenance scheduled for this weekend',
                    time: '1 day ago',
                    read: true,
                    icon: 'fa-cog',
                    color: 'purple'
                }
            ];

            if (notificationList) {
                if (notifications.length === 0) {
                    notificationList.innerHTML = `
                        <div class="p-4 text-center text-gray-400">
                            <i class="fas fa-bell text-2xl mb-2"></i>
                            <p>No notifications yet</p>
                        </div>
                    `;
                } else {
                    notificationList.innerHTML = notifications.map(notification => `
                        <div class="p-4 border-b border-gray-700 hover:bg-white hover:bg-opacity-5 transition-colors cursor-pointer ${!notification.read ? 'bg-white bg-opacity-5' : ''}" onclick="handleNotificationClick(${notification.id})">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-${notification.color}-500 bg-opacity-20 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas ${notification.icon} text-${notification.color}-400 text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <h4 class="text-white font-semibold text-sm truncate">${notification.title}</h4>
                                        ${!notification.read ? '<span class="w-2 h-2 bg-blue-500 rounded-full"></span>' : ''}
                                    </div>
                                    <p class="text-blue-300 text-xs mb-1 line-clamp-2">${notification.message}</p>
                                    <p class="text-gray-500 text-xs">${notification.time}</p>
                                </div>
                            </div>
                        </div>
                    `).join('');
                }
            }
        }

        function handleNotificationClick(id) {
            // Mark notification as read and redirect if needed
            markNotificationAsRead(id);
            console.log('Notification clicked:', id);
        }

        function markNotificationAsRead(id) {
            fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateNotificationBadge();
                    loadNotifications();
                }
            })
            .catch(error => {
                console.error('Error marking notification as read:', error);
            });
        }

        function markAllNotificationsRead() {
            fetch('/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('All notifications marked as read', 'success');
                    updateNotificationBadge();
                    loadNotifications();
                }
            })
            .catch(error => {
                console.error('Error marking all notifications as read:', error);
                showNotification('Error marking notifications as read', 'error');
            });
        }

        function updateNotificationBadge() {
            fetch('/notifications/unread-count')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('notification-badge');
                if (badge) {
                    if (data.count > 0) {
                        badge.style.display = 'block';
                        badge.textContent = data.count > 9 ? '9+' : data.count;
                    } else {
                        badge.style.display = 'none';
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching notification count:', error);
            });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const notificationDropdown = document.getElementById('notification-dropdown');
            const notificationButton = event.target.closest('button[onclick*="toggleNotificationDropdown"]');
            const userDropdown = document.getElementById('user-dropdown-menu');
            const userButton = event.target.closest('button[onclick*="toggleUserDropdown"]');
            
            // Close notification dropdown if clicking outside
            if (!notificationButton && notificationDropdown && !notificationDropdown.contains(event.target)) {
                notificationDropdown.classList.add('hidden');
            }
            
            // Close user dropdown if clicking outside the dropdown
            if (!userButton && userDropdown && !userDropdown.contains(event.target)) {
                if (userDropdown.classList.contains('show')) {
                    toggleUserDropdown();
                }
            }
        });

        // Close dropdowns when pressing ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const notificationDropdown = document.getElementById('notification-dropdown');
                const userDropdown = document.getElementById('user-dropdown-menu');
                
                if (notificationDropdown && !notificationDropdown.classList.contains('hidden')) {
                    notificationDropdown.classList.add('hidden');
                }
                
                if (userDropdown && userDropdown.classList.contains('show')) {
                    toggleUserDropdown();
                }
            }
        });
    </script>
</body>
</html>
