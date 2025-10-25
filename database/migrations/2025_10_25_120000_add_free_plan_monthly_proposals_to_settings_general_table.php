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
        Schema::table('settings_general', function (Blueprint $table) {
            $table->unsignedInteger('free_plan_monthly_proposals')
                ->default(30)
                ->after('freelancer_requires_approval');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings_general', function (Blueprint $table) {
            $table->dropColumn('free_plan_monthly_proposals');
        });
    }
};
