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
            if (!Schema::hasColumn('project_bids', 'compliance_answers')) {
                $table->json('compliance_answers')->nullable()->after('milestone_plan');
            }

            if (!Schema::hasColumn('project_bids', 'nda_signed_at')) {
                $table->timestamp('nda_signed_at')->nullable()->after('compliance_answers');
            }

            if (!Schema::hasColumn('project_bids', 'nda_signature')) {
                $table->string('nda_signature')->nullable()->after('nda_signed_at');
            }

            if (!Schema::hasColumn('project_bids', 'nda_signature_meta')) {
                $table->json('nda_signature_meta')->nullable()->after('nda_signature');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_bids', function (Blueprint $table): void {
            if (Schema::hasColumn('project_bids', 'nda_signature_meta')) {
                $table->dropColumn('nda_signature_meta');
            }

            if (Schema::hasColumn('project_bids', 'nda_signature')) {
                $table->dropColumn('nda_signature');
            }

            if (Schema::hasColumn('project_bids', 'nda_signed_at')) {
                $table->dropColumn('nda_signed_at');
            }

            if (Schema::hasColumn('project_bids', 'compliance_answers')) {
                $table->dropColumn('compliance_answers');
            }
        });
    }
};
