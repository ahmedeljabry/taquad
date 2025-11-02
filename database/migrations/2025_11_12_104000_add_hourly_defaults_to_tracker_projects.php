<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tracker_projects', function (Blueprint $table) {
            if (!Schema::hasColumn('tracker_projects', 'allow_manual_time_default')) {
                $table->boolean('allow_manual_time_default')
                    ->default(false)
                    ->after('weekly_limit_hours');
            }

            if (!Schema::hasColumn('tracker_projects', 'auto_approve_low_activity_default')) {
                $table->boolean('auto_approve_low_activity_default')
                    ->default(false)
                    ->after('allow_manual_time_default');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tracker_projects', function (Blueprint $table) {
            if (Schema::hasColumn('tracker_projects', 'auto_approve_low_activity_default')) {
                $table->dropColumn('auto_approve_low_activity_default');
            }

            if (Schema::hasColumn('tracker_projects', 'allow_manual_time_default')) {
                $table->dropColumn('allow_manual_time_default');
            }
        });
    }
};
