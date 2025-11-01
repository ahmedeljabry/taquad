<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('time_entries')) {
            return;
        }

        Schema::create('time_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('started_at')->index();
            $table->timestamp('ended_at');
            $table->unsignedSmallInteger('duration_minutes');
            $table->unsignedTinyInteger('activity_score')->default(0);
            $table->boolean('low_activity')->default(false);
            $table->boolean('is_manual')->default(false);
            $table->boolean('has_screenshot')->default(false);
            $table->boolean('created_from_tracker')->default(false);
            $table->text('memo')->nullable();
            $table->string('signature')->nullable();
            $table->string('client_status')->default('pending');
            $table->timestamp('client_reviewed_at')->nullable();
            $table->foreignId('client_reviewer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('client_notes')->nullable();
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();

            $table->unique(['contract_id', 'user_id', 'started_at'], 'time_entries_unique_slot');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_entries');
    }
};
