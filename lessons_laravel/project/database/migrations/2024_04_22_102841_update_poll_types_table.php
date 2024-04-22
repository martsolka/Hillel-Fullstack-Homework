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
        Schema::table('poll_types', function (Blueprint $table) {
            $table->string('name', 255)->change();
            $table->text('description')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('poll_types', function (Blueprint $table) {
            $table->string('name', 100)->comment('Name of poll type')->change();
            $table->dropColumn('description');
        });
    }
};
