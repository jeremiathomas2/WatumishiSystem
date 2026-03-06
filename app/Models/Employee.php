<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'department_id',
        'employee_number',
        'first_name',
        'last_name',
        'middle_name',
        'gender',
        'date_of_birth',
        'national_id',
        'passport_number',
        'work_permit_number',
        'work_permit_expiry',
        'employment_type',
        'hire_date',
        'probation_end_date',
        'contract_end_date',
        'job_title',
        'job_grade',
        'basic_salary',
        'allowances',
        'benefits',
        'bank_name',
        'bank_account_number',
        'email',
        'phone',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'marital_status',
        'number_of_dependents',
        'nssf_number',
        'tax_identification_number',
        'status',
        'termination_date',
        'termination_reason',
        'digital_signature',
        'is_union_member',
        'union_membership_number',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'work_permit_expiry' => 'date',
        'hire_date' => 'date',
        'probation_end_date' => 'date',
        'contract_end_date' => 'date',
        'basic_salary' => 'decimal:2',
        'allowances' => 'array',
        'benefits' => 'array',
        'termination_date' => 'date',
        'digital_signature' => 'array',
        'is_union_member' => 'boolean',
        'number_of_dependents' => 'integer',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function attendanceRecords()
    {
        return $this->hasMany(AttendanceRecord::class);
    }

    public function payrollRecords()
    {
        return $this->hasMany(PayrollRecord::class);
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function disciplineCases()
    {
        return $this->hasMany(DisciplineCase::class);
    }

    public function reportedDisciplineCases()
    {
        return $this->hasMany(DisciplineCase::class, 'reported_by');
    }

    public function approvedLeaveRequests()
    {
        return $this->hasMany(LeaveRequest::class, 'approved_by');
    }

    public function approvedPayrollRecords()
    {
        return $this->hasMany(PayrollRecord::class, 'approved_by');
    }

    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . ($this->middle_name ? $this->middle_name . ' ' : '') . $this->last_name);
    }

    public function getAgeAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }

    public function getYearsOfServiceAttribute()
    {
        return $this->hire_date ? $this->hire_date->diffInYears(now()) : null;
    }
}
