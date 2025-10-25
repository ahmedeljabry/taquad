<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->index();
            $table->decimal('amount', 12, 2);
            $table->string('provider', 50)->default('fake');
            $table->string('provider_ref')->nullable();
            $table->enum('status', ['pending','succeeded','failed'])->default('pending');
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onUpdate('no action')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

