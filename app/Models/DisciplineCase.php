<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisciplineCase extends Model
{
    protected $fillable = [
        'employee_id',
        'reported_by',
        'case_number',
        'incident_date',
        'incident_description',
        'misconduct_type',
        'case_status',
        'risk_level',
        'investigation_notes',
        'evidence_documents',
        'witness_statements',
        'hearing_date',
        'hearing_outcome',
        'disciplinary_action',
        'suspension_days',
        'suspension_start_date',
        'suspension_end_date',
        'hr_admin_id',
        'hr_admin_approval_at',
        'hr_admin_remarks',
        'is_legal_review_required',
        'legal_review_by',
        'legal_review_at',
        'legal_review_notes',
        'final_decision',
        'final_decision_date',
        'is_appeal_filed',
        'appeal_details',
    ];

    protected $casts = [
        'incident_date' => 'date',
        'hearing_date' => 'date',
        'suspension_start_date' => 'date',
        'suspension_end_date' => 'date',
        'hr_admin_approval_at' => 'datetime',
        'legal_review_at' => 'datetime',
        'final_decision_date' => 'date',
        'evidence_documents' => 'array',
        'witness_statements' => 'array',
        'is_legal_review_required' => 'boolean',
        'is_appeal_filed' => 'boolean',
        'suspension_days' => 'integer',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function reportedBy()
    {
        return $this->belongsTo(Employee::class, 'reported_by');
    }

    public function hrAdmin()
    {
        return $this->belongsTo(Employee::class, 'hr_admin_id');
    }

    public function legalReviewer()
    {
        return $this->belongsTo(Employee::class, 'legal_review_by');
    }
}
