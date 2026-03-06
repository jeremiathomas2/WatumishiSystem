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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('registration_number')->unique();
            $table->string('tax_identification_number')->unique();
            $table->enum('sector', ['manufacturing', 'services', 'agriculture', 'mining', 'construction', 'tourism', 'technology', 'other']);
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->enum('union_status', ['unionized', 'non_unionized']);
            $table->string('union_name')->nullable();
            $table->json('collective_agreement')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
