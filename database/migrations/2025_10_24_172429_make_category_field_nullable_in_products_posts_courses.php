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
        // Hacer nullable el campo category en products
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable()->change();
        });

        // Hacer nullable el campo category en posts
        Schema::table('posts', function (Blueprint $table) {
            $table->string('category')->nullable()->change();
        });

        // Hacer nullable el campo category en courses (si existe)
        if (Schema::hasColumn('courses', 'category')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->string('category')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir products
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable(false)->change();
        });

        // Revertir posts
        Schema::table('posts', function (Blueprint $table) {
            $table->string('category')->nullable(false)->change();
        });

        // Revertir courses
        if (Schema::hasColumn('courses', 'category')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->string('category')->nullable(false)->change();
            });
        }
    }
};
