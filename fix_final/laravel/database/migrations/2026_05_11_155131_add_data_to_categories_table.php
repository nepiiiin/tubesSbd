<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('categories')->insert([
            ['name' => 'discover'],
            ['name' => 'animation'],
            ['name' => 'branding'],
            ['name' => 'illustration'],
            ['name' => 'mobile'],
            ['name' => 'print'],
            ['name' => 'product-design'],
            ['name' => 'typography'],
            ['name' => 'web-design'],
        ]);
    }

    public function down(): void
    {
        DB::table('categories')->whereIn('name', [
            'discover',
            'animation',
            'branding',
            'illustration',
            'mobile',
            'print',
            'product-design',
            'typography',
            'web-design',
        ])->delete();
    }
};