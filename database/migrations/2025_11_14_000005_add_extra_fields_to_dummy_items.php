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
        Schema::table('dummy_items', function (Blueprint $table) {
            $table->string('color', 7)->default('#000000')->after('order');
            $table->string('icon', 100)->nullable()->after('color');
            $table->boolean('is_featured')->default(false)->after('icon');
            $table->text('notes')->nullable()->after('is_featured');
            $table->json('tags')->nullable()->after('notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dummy_items', function (Blueprint $table) {
            $table->dropColumn(['color', 'icon', 'is_featured', 'notes', 'tags']);
        });
    }
};
