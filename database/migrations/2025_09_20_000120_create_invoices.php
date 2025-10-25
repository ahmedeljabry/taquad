<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained('contracts')->cascadeOnDelete();

            $table->date('week_start_date');
            $table->date('week_end_date');
            $table->integer('total_minutes')->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->enum('status', ['open','billed','paid','disputed'])->default('open');
            $table->timestamps();

            $table->index(['contract_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

