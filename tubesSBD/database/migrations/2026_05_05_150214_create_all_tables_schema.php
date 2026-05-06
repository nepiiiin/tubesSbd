<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Matikan sementara pengecekan Foreign Key agar tidak error saat drop/create ulang
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 1. Drop tables if exist (agar benar-benar fresh)
        Schema::dropIfExists('brief_proposals');
        Schema::dropIfExists('project_briefs');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('follows');
        Schema::dropIfExists('collection_shots');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('shot_tags');
        Schema::dropIfExists('shot_categories');
        Schema::dropIfExists('services');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('shots');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('users');

        // 2. Create Tables (Urutan tidak terlalu penting di Raw SQL asalkan FK didefinisikan dengan benar)
        
        // --- INDEPENDENT TABLES ---
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('display_name')->nullable();
            $table->string('avatar_url')->nullable();
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('website_url')->nullable();
            $table->enum('account_type', ['free', 'PRO', 'PRO+'])->default('free');
            $table->boolean('is_available_for_hire')->default(false);
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('avatar_url')->nullable();
            $table->text('bio')->nullable();
            $table->string('website_url')->nullable();
            $table->timestamps();
        });

        // --- DEPENDENT TABLES ---
        Schema::create('shots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_url');
            $table->string('thumbnail_url')->nullable();
            $table->string('dominant_color_hex', 7)->nullable();
            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedBigInteger('likes_count')->default(0);
            $table->unsignedBigInteger('saves_count')->default(0);
            $table->boolean('is_animated')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category');
            $table->decimal('min_price', 10, 2)->default(0);
            $table->decimal('max_price', 10, 2)->default(0);
            $table->string('currency', 3)->default('USD');
            $table->integer('delivery_time_days')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_private')->default(false);
            $table->timestamps();
        });

        // --- PIVOT & CHILD TABLES ---
        Schema::create('shot_categories', function (Blueprint $table) {
            $table->foreignId('shot_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->primary(['shot_id', 'category_id']);
        });

        Schema::create('shot_tags', function (Blueprint $table) {
            $table->foreignId('shot_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['shot_id', 'tag_id']);
        });

        Schema::create('likes', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shot_id')->constrained()->cascadeOnDelete();
            $table->primary(['user_id', 'shot_id']);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shot_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_comment_id')->nullable()->constrained('comments')->nullOnDelete();
            $table->text('body');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });

        Schema::create('collection_shots', function (Blueprint $table) {
            $table->foreignId('collection_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shot_id')->constrained()->cascadeOnDelete();
            $table->primary(['collection_id', 'shot_id']);
            $table->integer('position')->default(0);
            $table->timestamp('added_at')->useCurrent();
        });

        Schema::create('follows', function (Blueprint $table) {
            $table->foreignId('follower_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('following_id')->constrained('users')->cascadeOnDelete();
            $table->primary(['follower_id', 'following_id']);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('team_members', function (Blueprint $table) {
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('role', ['owner', 'admin', 'member'])->default('member');
            $table->primary(['team_id', 'user_id']);
            $table->timestamp('joined_at')->useCurrent();
        });

        // --- COMPLEX: Briefs & Proposals (Circular FK Handling) ---
        Schema::create('brief_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brief_id')->constrained('project_briefs')->cascadeOnDelete();
            $table->foreignId('designer_user_id')->constrained('users')->cascadeOnDelete();
            $table->text('cover_letter')->nullable();
            $table->decimal('proposed_price', 10, 2);
            $table->integer('estimated_days');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });

        Schema::create('project_briefs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_user_id')->constrained('users')->cascadeOnDelete();
            // Kita buat kolomnya dulu, FK-nya kita tambah manual di bawah untuk menghindari circular error
            $table->unsignedBigInteger('selected_proposal_id')->nullable(); 
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('budget_min', 10, 2)->nullable();
            $table->decimal('budget_max', 10, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->date('deadline')->nullable();
            $table->enum('status', ['open', 'in_progress', 'completed', 'cancelled'])->default('open');
            $table->timestamps();
        });

        // Tambahkan Foreign Key manual untuk circular reference
        DB::statement('ALTER TABLE project_briefs ADD CONSTRAINT fk_selected_proposal FOREIGN KEY (selected_proposal_id) REFERENCES brief_proposals(id) ON DELETE SET NULL');

        // Nyalakan kembali pengecekan Foreign Key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down(): void
    {
        // Cukup drop semua tabel, urutannya tidak masalah karena FK checks dimatikan di up()
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Schema::dropIfExists('brief_proposals');
        Schema::dropIfExists('project_briefs');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('follows');
        Schema::dropIfExists('collection_shots');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('shot_tags');
        Schema::dropIfExists('shot_categories');
        Schema::dropIfExists('services');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('shots');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('users');
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};