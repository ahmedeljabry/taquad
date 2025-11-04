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
        if (! Schema::hasTable('conversation_participants')) {
            Schema::create('conversation_participants', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('conversation_id');
                $table->unsignedBigInteger('user_id');
                $table->enum('role', ['client', 'freelancer'])->nullable();
                $table->unsignedBigInteger('last_read_message_id')->nullable();
                $table->timestamp('last_seen_at')->nullable();
                $table->timestamps();

                $table->foreign('conversation_id')
                    ->references('id')
                    ->on('conversations')
                    ->cascadeOnDelete();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnDelete();

                $table->unique(['conversation_id', 'user_id']);
                $table->index(['user_id', 'created_at']);
            });

            return;
        }

        $hasRoleColumn = Schema::hasColumn('conversation_participants', 'role');
        $hasLastReadColumn = Schema::hasColumn('conversation_participants', 'last_read_message_id');
        $hasLastSeenColumn = Schema::hasColumn('conversation_participants', 'last_seen_at');

        Schema::table('conversation_participants', function (Blueprint $table) use ($hasRoleColumn, $hasLastReadColumn, $hasLastSeenColumn) {
            $afterColumn = 'user_id';

            if ($hasRoleColumn) {
                $afterColumn = 'role';
            }

            if (! $hasRoleColumn) {
                $table->enum('role', ['client', 'freelancer'])->nullable()->after('user_id');
                $afterColumn = 'role';
            }

            if (! $hasLastReadColumn) {
                $table->unsignedBigInteger('last_read_message_id')->nullable()->after($afterColumn);
                $afterColumn = 'last_read_message_id';
            } else {
                $afterColumn = 'last_read_message_id';
            }

            if (! $hasLastSeenColumn) {
                $table->timestamp('last_seen_at')->nullable()->after($afterColumn);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_participants');
    }
};
