<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracker_refresh_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('client_id');
            $table->string('token', 128)->unique();
            $table->boolean('revoked')->default(false);
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->index(['user_id', 'client_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracker_refresh_tokens');
    }
};
