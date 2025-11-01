<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_decisions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('requested_by_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('responded_by_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('requested_by_role', ['client', 'freelancer']);
            $table->enum('type', ['deliver', 'cancel']);
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->text('message')->nullable();
            $table->text('response_message')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_decisions');
    }
};
