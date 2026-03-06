<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\ComplianceController;
use App\Http\Controllers\PoliciesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;

// Splash screen
Route::get('/', [AuthController::class, 'showSplash'])->name('splash');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Employee Management Routes
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    
    // Department Routes
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/{id}', [DepartmentController::class, 'show'])->name('departments.show');
    Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('/departments/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
    
    // Recruitment Routes
    Route::get('/recruitment', [RecruitmentController::class, 'index'])->name('recruitment.index');
    Route::get('/recruitment/jobs/create', [RecruitmentController::class, 'createJob'])->name('recruitment.jobs.create');
    Route::post('/recruitment/jobs', [RecruitmentController::class, 'storeJob'])->name('recruitment.jobs.store');
    Route::get('/recruitment/jobs/{id}', [RecruitmentController::class, 'showJob'])->name('recruitment.jobs.show');
    Route::get('/recruitment/applications', [RecruitmentController::class, 'applications'])->name('recruitment.applications');
    Route::get('/recruitment/applications/{id}', [RecruitmentController::class, 'showApplication'])->name('recruitment.applications.show');
    
    // Training Routes
    Route::get('/training', [TrainingController::class, 'index'])->name('training.index');
    Route::get('/training/create', [TrainingController::class, 'create'])->name('training.create');
    Route::post('/training', [TrainingController::class, 'store'])->name('training.store');
    Route::get('/training/{id}', [TrainingController::class, 'show'])->name('training.show');
    Route::get('/training/{id}/edit', [TrainingController::class, 'edit'])->name('training.edit');
    Route::put('/training/{id}', [TrainingController::class, 'update'])->name('training.update');
    Route::get('/training/{id}/participants', [TrainingController::class, 'participants'])->name('training.participants');
    Route::get('/training/materials', [TrainingController::class, 'materials'])->name('training.materials');
    
    // Operations Routes
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/mark', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
    Route::get('/attendance/report', [AttendanceController::class, 'getAttendanceReport'])->name('attendance.report');
    
    Route::get('/leave', [LeaveController::class, 'index'])->name('leave.index');
    Route::post('/leave/request', [LeaveController::class, 'createRequest'])->name('leave.request');
    Route::post('/leave/{id}/approve', [LeaveController::class, 'approveRequest'])->name('leave.approve');
    Route::post('/leave/{id}/reject', [LeaveController::class, 'rejectRequest'])->name('leave.reject');
    Route::get('/leave/balance/{employeeId}', [LeaveController::class, 'getLeaveBalance'])->name('leave.balance');
    
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
    Route::post('/payroll/process', [PayrollController::class, 'processPayroll'])->name('payroll.process');
    Route::get('/payroll/payslip/{employeeId}/{month}/{year}', [PayrollController::class, 'generatePayslip'])->name('payroll.payslip');
    Route::get('/payroll/export', [PayrollController::class, 'exportPayrollReport'])->name('payroll.export');
    
    Route::get('/performance', [PerformanceController::class, 'index'])->name('performance.index');
    Route::post('/performance/review', [PerformanceController::class, 'createReview'])->name('performance.review');
    Route::put('/performance/review/{id}', [PerformanceController::class, 'updateReview'])->name('performance.update');
    Route::get('/performance/{employeeId}', [PerformanceController::class, 'getEmployeePerformance'])->name('performance.employee');
    
    // Compliance Routes
    Route::get('/compliance', [ComplianceController::class, 'index'])->name('compliance.index');
    Route::post('/compliance/update', [ComplianceController::class, 'updateCompliance'])->name('compliance.update');
    Route::get('/compliance/report', [ComplianceController::class, 'generateReport'])->name('compliance.report');
    Route::post('/compliance/upload', [ComplianceController::class, 'uploadDocument'])->name('compliance.upload');
    
    Route::get('/discipline', [DisciplineController::class, 'index'])->name('discipline.index');
    Route::post('/discipline/create', [DisciplineController::class, 'createCase'])->name('discipline.create');
    Route::put('/discipline/{id}', [DisciplineController::class, 'updateCase'])->name('discipline.update');
    Route::post('/discipline/{id}/hearing', [DisciplineController::class, 'scheduleHearing'])->name('discipline.hearing');
    Route::post('/discipline/{id}/close', [DisciplineController::class, 'closeCase'])->name('discipline.close');
    
    // Legal Compliance Routes
    Route::get('/compliance/legal', [ComplianceController::class, 'legal'])->name('compliance.legal');
    Route::get('/compliance/policies', [PoliciesController::class, 'index'])->name('compliance.policies');
    Route::post('/compliance/policies/create', [PoliciesController::class, 'createPolicy'])->name('compliance.policies.create');
    Route::put('/compliance/policies/{id}', [PoliciesController::class, 'updatePolicy'])->name('compliance.policies.update');
    Route::delete('/compliance/policies/{id}', [PoliciesController::class, 'deletePolicy'])->name('compliance.policies.delete');
    Route::post('/compliance/policies/{id}/acknowledge', [PoliciesController::class, 'acknowledgePolicy'])->name('compliance.policies.acknowledge');
    
    // System Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [SettingsController::class, 'updateSettings'])->name('settings.update');
    Route::post('/settings/cache/clear', [SettingsController::class, 'resetCache'])->name('settings.cache.clear');
    Route::post('/settings/database/optimize', [SettingsController::class, 'optimizeDatabase'])->name('settings.optimize');
    Route::post('/settings/backup', [SettingsController::class, 'createBackup'])->name('settings.backup');
    
    // User Profile Routes
    Route::get('/profile', [SettingsController::class, 'profile'])->name('profile.index');
    Route::post('/profile/update', [SettingsController::class, 'updateProfile'])->name('profile.update');
    
    // Password Routes
    Route::get('/password/change', [SettingsController::class, 'changePassword'])->name('password.change');
    Route::post('/password/update', [SettingsController::class, 'updatePassword'])->name('password.update');
    
    // Notifications Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::delete('/notifications/{id}', [NotificationController::class, 'deleteNotification'])->name('notifications.delete');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
    
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users/create', [UsersController::class, 'createUser'])->name('users.create');
    Route::put('/users/{id}', [UsersController::class, 'updateUser'])->name('users.update');
    Route::post('/users/{id}/deactivate', [UsersController::class, 'deactivateUser'])->name('users.deactivate');
    Route::post('/users/{id}/reset-password', [UsersController::class, 'resetPassword'])->name('users.reset-password');
    Route::get('/users/{id}/activity', [UsersController::class, 'getUserActivity'])->name('users.activity');
    
    // Backup Routes
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup/create', [BackupController::class, 'createBackup'])->name('backup.create');
    Route::post('/backup/{id}/restore', [BackupController::class, 'restoreBackup'])->name('backup.restore');
    Route::delete('/backup/{id}', [BackupController::class, 'deleteBackup'])->name('backup.delete');
    Route::get('/backup/{id}/download', [BackupController::class, 'downloadBackup'])->name('backup.download');
    Route::post('/backup/schedule', [BackupController::class, 'scheduleBackup'])->name('backup.schedule');
    
    // Audit Routes
    Route::get('/audit', [AuditController::class, 'index'])->name('audit.index');
    Route::get('/audit/logs', [AuditController::class, 'getLogs'])->name('audit.logs');
    Route::get('/audit/export', [AuditController::class, 'exportLogs'])->name('audit.export');
    Route::post('/audit/search', [AuditController::class, 'searchLogs'])->name('audit.search');
    
    // Reports routes
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/financial', [ReportController::class, 'financial'])->name('financial');
        Route::get('/attendance', [ReportController::class, 'attendance'])->name('attendance');
        Route::get('/performance', [ReportController::class, 'performance'])->name('performance');
        Route::get('/export/{type}', [ReportController::class, 'export'])->name('export');
    });
    
    // Admin routes (will be expanded)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });
    
    // Offline route
    Route::get('/offline', function () {
        return view('offline');
    })->name('offline');
});
