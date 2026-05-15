<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // shots
        Schema::create('shots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_url');
            $table->timestamps();
        });

        // likes
        Schema::create('likes', function (Blueprint $table) {
            $table->foreignId('shot_id')->constrained('shots')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->primary(['shot_id', 'user_id']);
        });

        // comments
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shot_id')->constrained('shots')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('body');
            $table->timestamps();
        });

        //follows
        Schema::create('follows', function (Blueprint $table) {
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('following_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();

            $table->primary(['follower_id', 'following_id']);
        });

       //collections
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });
        
        //collection items
        Schema::create('collection_items', function (Blueprint $table) {
            $table->foreignId('collection_id')->constrained('collections')->onDelete('cascade');
            $table->foreignId('shot_id')->constrained('shots')->onDelete('cascade');
            $table->timestamp('added_at')->useCurrent();
        });

        // tags
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        //shot tags 
        Schema::create('shot_tags', function (Blueprint $table) {
            $table->foreignId('shot_id')->constrained('shots')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');
        });

        // categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        //shot categories
        Schema::create('shot_categories', function (Blueprint $table) {
            $table->foreignId('shot_id')->constrained('shots')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Drop tabel dengan urutan terbalik untuk menghindari error Foreign Key
        Schema::dropIfExists('shot_categories');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('shot_tags');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('collection_items');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('follows');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('shots');
    }
};