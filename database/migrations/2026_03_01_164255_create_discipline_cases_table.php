<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('discipline_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reported_by')->constrained('employees')->cascadeOnDelete();
            $table->string('case_number')->unique();
            $table->date('incident_date');
            $table->text('incident_description');
            $table->enum('misconduct_type', ['minor', 'serious', 'gross']);
            $table->enum('case_status', ['reported', 'investigation', 'hearing_scheduled', 'hearing_adjourned', 'decision_pending', 'closed', 'appealed'])->default('reported');
            $table->enum('risk_level', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->text('investigation_notes')->nullable();
            $table->json('evidence_documents')->nullable();
            $table->json('witness_statements')->nullable();
            $table->date('hearing_date')->nullable();
            $table->text('hearing_outcome')->nullable();
            $table->enum('disciplinary_action', ['none', 'verbal_warning', 'written_warning', 'suspension', 'demotion', 'termination'])->nullable();
            $table->integer('suspension_days')->nullable();
            $table->date('suspension_start_date')->nullable();
            $table->date('suspension_end_date')->nullable();
            $table->foreignId('hr_admin_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->timestamp('hr_admin_approval_at')->nullable();
            $table->text('hr_admin_remarks')->nullable();
            $table->boolean('is_legal_review_required')->default(false);
            $table->foreignId('legal_review_by')->nullable()->constrained('employees')->nullOnDelete();
            $table->timestamp('legal_review_at')->nullable();
            $table->text('legal_review_notes')->nullable();
            $table->text('final_decision')->nullable();
            $table->date('final_decision_date')->nullable();
            $table->boolean('is_appeal_filed')->default(false);
            $table->text('appeal_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discipline_cases');
    }
};
