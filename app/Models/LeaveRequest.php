<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = [
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'days_requested',
        'days_approved',
        'reason',
        'status',
        'approved_by',
        'approved_at',
        'approval_remarks',
        'contact_during_leave',
        'emergency_contact',
        'supporting_documents',
        'is_paid_leave',
        'leave_pay_rate',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
        'supporting_documents' => 'array',
        'is_paid_leave' => 'boolean',
        'leave_pay_rate' => 'decimal:2',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }
}
