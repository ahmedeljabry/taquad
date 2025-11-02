<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracker_project_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracker_project_id')->constrained('tracker_projects')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('role', 32)->default('freelancer');
            $table->decimal('hourly_rate', 12, 2)->nullable();
            $table->decimal('weekly_limit_hours', 6, 2)->nullable();
            $table->enum('status', ['pending', 'active', 'removed'])->default('active');
            $table->timestamp('invited_at')->nullable();
            $table->timestamp('joined_at')->nullable();
            $table->foreignId('added_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['tracker_project_id', 'user_id'], 'tracker_project_member_unique');
            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracker_project_members');
    }
};

