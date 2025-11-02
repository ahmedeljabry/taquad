<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('time_entries')) {
            return;
        }

        Schema::table('time_entries', function (Blueprint $table) {
            if (! Schema::hasColumn('time_entries', 'invoice_id')) {
                $table->foreignId('invoice_id')
                    ->nullable()
                    ->after('contract_id')
                    ->constrained('invoices')
                    ->nullOnDelete();
            }

            if (! Schema::hasColumn('time_entries', 'status')) {
                $table->string('status', 32)
                    ->default('in_progress')
                    ->after('created_from_tracker');
                $table->index('status', 'time_entries_status_idx');
            }

            if (! Schema::hasColumn('time_entries', 'billing_status')) {
                $table->string('billing_status', 32)
                    ->default('draft')
                    ->after('status');
                $table->index('billing_status', 'time_entries_billing_status_idx');
            }

            if (! Schema::hasColumn('time_entries', 'review_locked_at')) {
                $table->timestamp('review_locked_at')
                    ->nullable()
                    ->after('client_reviewed_at');
            }

            if (! Schema::hasColumn('time_entries', 'payout_available_at')) {
                $table->timestamp('payout_available_at')
                    ->nullable()
                    ->after('review_locked_at');
            }

            if (! Schema::hasColumn('time_entries', 'note')) {
                $table->text('note')
                    ->nullable()
                    ->after('memo');
            }

            if (! Schema::hasColumn('time_entries', 'activity_seconds')) {
                $table->unsignedInteger('activity_seconds')
                    ->nullable()
                    ->after('duration_minutes');
            }
        });

        if (! $this->indexExists('time_entries', 'time_entries_contract_started_idx')) {
            Schema::table('time_entries', function (Blueprint $table) {
                $table->index(['contract_id', 'started_at'], 'time_entries_contract_started_idx');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('time_entries')) {
            return;
        }

        Schema::table('time_entries', function (Blueprint $table) {
            if (Schema::hasColumn('time_entries', 'invoice_id')) {
                $table->dropForeign(['invoice_id']);
                $table->dropColumn('invoice_id');
            }

            if (Schema::hasColumn('time_entries', 'status')) {
                if ($this->indexExists('time_entries', 'time_entries_status_idx')) {
                    $table->dropIndex('time_entries_status_idx');
                }
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('time_entries', 'billing_status')) {
                if ($this->indexExists('time_entries', 'time_entries_billing_status_idx')) {
                    $table->dropIndex('time_entries_billing_status_idx');
                }
                $table->dropColumn('billing_status');
            }

            if (Schema::hasColumn('time_entries', 'review_locked_at')) {
                $table->dropColumn('review_locked_at');
            }

            if (Schema::hasColumn('time_entries', 'payout_available_at')) {
                $table->dropColumn('payout_available_at');
            }

            if (Schema::hasColumn('time_entries', 'note')) {
                $table->dropColumn('note');
            }

            if (Schema::hasColumn('time_entries', 'activity_seconds')) {
                $table->dropColumn('activity_seconds');
            }

            if ($this->indexExists('time_entries', 'time_entries_contract_started_idx')) {
                $table->dropIndex('time_entries_contract_started_idx');
            }
        });
    }

    private function indexExists(string $table, string $index): bool
    {
        $connection = Schema::getConnection();

        return DB::table('information_schema.STATISTICS')
            ->where('TABLE_SCHEMA', $connection->getDatabaseName())
            ->where('TABLE_NAME', $connection->getTablePrefix() . $table)
            ->where('INDEX_NAME', $index)
            ->exists();
    }
};
