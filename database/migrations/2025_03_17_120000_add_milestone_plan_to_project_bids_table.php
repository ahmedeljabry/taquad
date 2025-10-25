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
        Schema::table('project_bids', function (Blueprint $table) {
            if (!Schema::hasColumn('project_bids', 'milestone_plan')) {
                $table->json('milestone_plan')->nullable()->after('message');
            }

            if (!Schema::hasColumn('project_bids', 'milestone_plan_applied_at')) {
                $table->timestamp('milestone_plan_applied_at')->nullable()->after('milestone_plan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_bids', function (Blueprint $table) {
            if (Schema::hasColumn('project_bids', 'milestone_plan_applied_at')) {
                $table->dropColumn('milestone_plan_applied_at');
            }

            if (Schema::hasColumn('project_bids', 'milestone_plan')) {
                $table->dropColumn('milestone_plan');
            }
        });
    }
};
