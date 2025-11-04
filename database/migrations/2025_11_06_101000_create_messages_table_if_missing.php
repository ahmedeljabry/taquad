<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('messages')) {
            return;
        }

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

        if (Schema::hasColumn('conversations', 'last_message_id')) {
            try {
                Schema::table('conversations', function (Blueprint $table) {
                    $table->foreign('last_message_id')
                        ->references('id')
                        ->on('messages')
                        ->nullOnDelete();
                });
            } catch (\Throwable $exception) {
                // Ignore if FK already exists.
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
