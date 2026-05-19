<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('job_id')
                ->constrained('jobs')
                ->onDelete('cascade');
            
            $table->foreignId('applicant_id')
                ->constrained('users')
                ->onDelete('cascade');
            
            $table->text('cover_letter')->nullable();
            $table->string('resume_url')->nullable();
            $table->enum('status', ['pending', 'reviewed', 'interview', 'offered', 'rejected'])
                  ->default('pending');
            $table->timestamp('applied_at')->useCurrent(); // ✅ sesuai ERD
            $table->timestamps(); // created_at & updated_at
            
            $table->unique(['job_id', 'applicant_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};