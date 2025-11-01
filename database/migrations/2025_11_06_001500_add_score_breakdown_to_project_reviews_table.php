<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('project_reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('project_reviews', 'score_breakdown')) {
                $table->json('score_breakdown')->nullable()->after('score');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_reviews', function (Blueprint $table) {
            if (Schema::hasColumn('project_reviews', 'score_breakdown')) {
                $table->dropColumn('score_breakdown');
            }
        });
    }
};
