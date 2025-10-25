<?php

use Composer\Semver\Constraint\Constraint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_restricted')->default(false)->after('status');
            $table->foreignId('restriction_id')->constrained('user_restrictions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_restricted');
            $table->dropColumn('restriction_id');
        });
    }
};
