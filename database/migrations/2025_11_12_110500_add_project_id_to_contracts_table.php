<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('contracts')) {
            return;
        }

        Schema::table('contracts', function (Blueprint $table) {
            if (! Schema::hasColumn('contracts', 'project_id')) {
                $table->foreignId('project_id')
                    ->nullable()
                    ->after('tracker_project_id')
                    ->constrained('projects')
                    ->nullOnDelete();
                $table->index('project_id');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('contracts')) {
            return;
        }

        Schema::table('contracts', function (Blueprint $table) {
            if (Schema::hasColumn('contracts', 'project_id')) {
                $table->dropForeign(['project_id']);
                $table->dropColumn('project_id');
            }
        });
    }
};
