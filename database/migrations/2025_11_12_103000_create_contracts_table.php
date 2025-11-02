<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('contracts')) {
            return;
        }

        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracker_project_id')->constrained('tracker_projects')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('freelancer_id')->constrained('users')->cascadeOnDelete();
            $table->enum('type', ['hourly', 'fixed'])->default('hourly');
            $table->enum('status', ['offer_sent', 'active', 'paused', 'ended'])->default('offer_sent');
            $table->decimal('hourly_rate', 12, 2)->default(0);
            $table->decimal('weekly_limit_hours', 6, 2)->nullable();
            $table->boolean('allow_manual_time')->default(false);
            $table->boolean('auto_approve_low_activity')->default(false);
            $table->string('currency_code', 3)->default('USD');
            $table->string('timezone')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['freelancer_id', 'status']);
            $table->index(['client_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};

