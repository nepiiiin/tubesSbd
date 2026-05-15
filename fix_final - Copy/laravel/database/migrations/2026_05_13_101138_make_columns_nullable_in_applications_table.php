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
        Schema::table('applications', function (Blueprint $table) {

            $table->text('cover_letter')->nullable()->change();

            $table->string('resume_url')->nullable()->change();

            $table->string('status')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {

            $table->text('cover_letter')->nullable(false)->change();

            $table->string('resume_url')->nullable(false)->change();

            $table->string('status')->nullable(false)->change();

        });
    }
};