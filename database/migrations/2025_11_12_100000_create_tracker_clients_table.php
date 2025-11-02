<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracker_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('contact_email')->unique();
            $table->string('contact_phone')->nullable();
            $table->string('timezone')->nullable();
            $table->string('currency_code', 3)->default('USD');
            $table->json('billing_preferences')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracker_clients');
    }
};

