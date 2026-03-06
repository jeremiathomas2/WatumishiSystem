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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->string('employee_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('date_of_birth');
            $table->string('national_id')->unique();
            $table->string('passport_number')->nullable();
            $table->string('work_permit_number')->nullable();
            $table->date('work_permit_expiry')->nullable();
            $table->enum('employment_type', ['permanent', 'contract', 'probation', 'casual', 'intern']);
            $table->date('hire_date');
            $table->date('probation_end_date')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->string('job_title');
            $table->string('job_grade');
            $table->decimal('basic_salary', 12, 2);
            $table->json('allowances')->nullable();
            $table->json('benefits')->nullable();
            $table->string('bank_name');
            $table->string('bank_account_number');
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('address');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->integer('number_of_dependents')->default(0);
            $table->string('nssf_number')->nullable();
            $table->string('tax_identification_number')->nullable();
            $table->enum('status', ['active', 'inactive', 'terminated', 'resigned', 'retired'])->default('active');
            $table->date('termination_date')->nullable();
            $table->text('termination_reason')->nullable();
            $table->json('digital_signature')->nullable();
            $table->boolean('is_union_member')->default(false);
            $table->string('union_membership_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
