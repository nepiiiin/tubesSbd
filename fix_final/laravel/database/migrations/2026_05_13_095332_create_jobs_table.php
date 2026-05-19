<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('poster_id')
                ->constrained('users')
                ->onDelete('cascade');
            
            $table->string('title');
            $table->string('company_name');
            $table->string('location')->nullable(); // ✅ nullable sesuai ERD
            $table->enum('job_type', ['full-time', 'part-time', 'freelance', 'contract']); // ✅ enum
            $table->text('description');
            $table->string('apply_url')->nullable(); // ✅ nullable
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};