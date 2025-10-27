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
        Schema::table('project_bids', function (Blueprint $table): void {
            if (!Schema::hasColumn('project_bids', 'last_viewed_at')) {
                $table->timestamp('last_viewed_at')->nullable()->after('freelancer_rejected_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_bids', function (Blueprint $table): void {
            if (Schema::hasColumn('project_bids', 'last_viewed_at')) {
                $table->dropColumn('last_viewed_at');
            }
        });
    }
};
