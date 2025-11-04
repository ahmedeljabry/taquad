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
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('user_id');
            $table->string('type', 30)->default('text');
            $table->longText('body')->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('edited_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('conversation_id')
                ->references('id')
                ->on('conversations')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->index(['conversation_id', 'created_at']);
            $table->index(['user_id', 'created_at']);
        });

        if (Schema::hasTable('conversations') && Schema::hasColumn('conversations', 'last_message_id')) {
            Schema::table('conversations', function (Blueprint $table) {
                $table->foreign('last_message_id')
                    ->references('id')
                    ->on('messages')
                    ->nullOnDelete();
            });
        }

        if (Schema::hasTable('conversation_participants') && Schema::hasColumn('conversation_participants', 'last_read_message_id')) {
            Schema::table('conversation_participants', function (Blueprint $table) {
                $table->foreign('last_read_message_id')
                    ->references('id')
                    ->on('messages')
                    ->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('conversations') && Schema::hasColumn('conversations', 'last_message_id')) {
            Schema::table('conversations', function (Blueprint $table) {
                try {
                    $table->dropForeign(['last_message_id']);
                } catch (\Throwable $th) {
                }
            });
        }

        if (Schema::hasTable('conversation_participants') && Schema::hasColumn('conversation_participants', 'last_read_message_id')) {
            Schema::table('conversation_participants', function (Blueprint $table) {
                try {
                    $table->dropForeign(['last_read_message_id']);
                } catch (\Throwable $th) {
                    // Foreign key might not exist yet; ignore.
                }
            });
        }

        Schema::dropIfExists('messages');
    }
};
