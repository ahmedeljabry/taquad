<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('conversation_participants')) {
            return;
        }

        Schema::table('conversation_participants', function (Blueprint $table) {
            if (! Schema::hasColumn('conversation_participants', 'last_read_message_id')) {
                $table->unsignedBigInteger('last_read_message_id')
                    ->nullable()
                    ->after('last_read_at');

                $table->index('last_read_message_id', 'conversation_participants_last_read_message_id_idx');
            }

            if (! Schema::hasColumn('conversation_participants', 'last_seen_at')) {
                $table->timestamp('last_seen_at')
                    ->nullable()
                    ->after('last_read_message_id');
            }
        });

        if (Schema::hasColumn('conversation_participants', 'last_read_message_id') && Schema::hasTable('messages')) {
            try {
                Schema::table('conversation_participants', function (Blueprint $table) {
                    $table->foreign('last_read_message_id', 'conversation_participants_last_read_message_id_foreign')
                        ->references('id')
                        ->on('messages')
                        ->nullOnDelete();
                });
            } catch (\Throwable $exception) {
                // Foreign key may already exist from previous deployments.
            }
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('conversation_participants')) {
            return;
        }

        Schema::table('conversation_participants', function (Blueprint $table) {
            if (Schema::hasColumn('conversation_participants', 'last_read_message_id')) {
                try {
                    $table->dropForeign(['last_read_message_id']);
                } catch (\Throwable $exception) {
                    // Swallow if FK was never created.
                }

                $table->dropColumn('last_read_message_id');
            }

            if (Schema::hasColumn('conversation_participants', 'last_seen_at')) {
                $table->dropColumn('last_seen_at');
            }
        });
    }
};
