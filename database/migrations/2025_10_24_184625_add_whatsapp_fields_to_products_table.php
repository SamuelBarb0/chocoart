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
        Schema::table('products', function (Blueprint $table) {
            $table->text('whatsapp_message')->nullable()->after('published');
            $table->time('available_from')->nullable()->after('whatsapp_message');
            $table->time('available_to')->nullable()->after('available_from');
            $table->boolean('whatsapp_enabled')->default(true)->after('available_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['whatsapp_message', 'available_from', 'available_to', 'whatsapp_enabled']);
        });
    }
};
