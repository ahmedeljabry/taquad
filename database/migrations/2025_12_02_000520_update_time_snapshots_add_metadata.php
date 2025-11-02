<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('time_snapshots')) {
            return;
        }

        Schema::table('time_snapshots', function (Blueprint $table) {
            if (! Schema::hasColumn('time_snapshots', 'blur_level')) {
                $table->unsignedTinyInteger('blur_level')->nullable()->after('disk');
            }

            if (! Schema::hasColumn('time_snapshots', 'hash')) {
                $table->string('hash', 128)->nullable()->after('blur_level');
                $table->index('hash', 'time_snapshots_hash_idx');
            }

            if (! Schema::hasColumn('time_snapshots', 'size_bytes')) {
                $table->unsignedInteger('size_bytes')->nullable()->after('hash');
            }

            if (! Schema::hasColumn('time_snapshots', 'is_encrypted')) {
                $table->boolean('is_encrypted')->default(true)->after('size_bytes');
            }

            if (! Schema::hasColumn('time_snapshots', 'meta')) {
                $table->json('meta')->nullable()->after('is_encrypted');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('time_snapshots')) {
            return;
        }

        Schema::table('time_snapshots', function (Blueprint $table) {
            if (Schema::hasColumn('time_snapshots', 'meta')) {
                $table->dropColumn('meta');
            }

            if (Schema::hasColumn('time_snapshots', 'is_encrypted')) {
                $table->dropColumn('is_encrypted');
            }

            if (Schema::hasColumn('time_snapshots', 'size_bytes')) {
                $table->dropColumn('size_bytes');
            }

            if (Schema::hasColumn('time_snapshots', 'hash')) {
                $table->dropIndex('time_snapshots_hash_idx');
                $table->dropColumn('hash');
            }

            if (Schema::hasColumn('time_snapshots', 'blur_level')) {
                $table->dropColumn('blur_level');
            }
        });
    }
};
