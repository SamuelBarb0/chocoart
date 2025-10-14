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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->longText('content')->nullable();
            $table->string('level'); // Básico, Avanzado, Masterclass
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('duration_hours')->nullable();
            $table->string('icon')->default('📚');
            $table->string('color')->default('#e28dc4'); // Color para el badge
            $table->string('image')->nullable();
            $table->boolean('published')->default(true);
            $table->integer('order')->default(0);

            // Detalles del curso
            $table->json('features')->nullable(); // Lista de características
            $table->json('requirements')->nullable(); // Requisitos
            $table->json('includes')->nullable(); // Qué incluye
            $table->date('start_date')->nullable();
            $table->integer('max_students')->nullable();

            // SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
