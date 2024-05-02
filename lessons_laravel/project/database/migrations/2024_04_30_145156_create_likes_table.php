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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained()->unique()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained()->unique()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('liked_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['news_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('likes');
    }
};
