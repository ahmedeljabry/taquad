<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracker_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracker_client_id')->constrained('tracker_clients')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('reference_code')->nullable()->unique();
            $table->text('description')->nullable();
            $table->decimal('default_hourly_rate', 12, 2)->nullable();
            $table->decimal('weekly_limit_hours', 6, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();

            $table->index(['tracker_client_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracker_projects');
    }
};

