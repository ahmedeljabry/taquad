<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('wallet_transactions')) {
            return;
        }

        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('type', 32);
            $table->decimal('amount', 12, 2);
            $table->char('currency', 3);
            $table->nullableMorphs('related');
            $table->string('status', 32)->default('pending');
            $table->string('idempotency_key', 100)->unique();
            $table->json('meta')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'type', 'status'], 'wallet_transactions_lookup_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
