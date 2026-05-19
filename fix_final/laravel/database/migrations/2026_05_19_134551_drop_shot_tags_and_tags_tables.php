<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('shot_tags');
        Schema::dropIfExists('tags');
    }

    public function down(): void
    {
    }
};