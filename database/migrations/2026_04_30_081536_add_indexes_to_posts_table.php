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
        Schema::table('posts', function (Blueprint $table) {
            $table->index('hidden');
            $table->index('pinned');
            $table->index('views');
            $table->index('likes');
            $table->index('created_at');
            $table->index(['hidden', 'pinned']);
            $table->index(['category_id', 'hidden']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['hidden']);
            $table->dropIndex(['pinned']);
            $table->dropIndex(['views']);
            $table->dropIndex(['likes']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['hidden', 'pinned']);
            $table->dropIndex(['category_id', 'hidden']);
        });
    }
};
