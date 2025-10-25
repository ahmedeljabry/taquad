<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disputes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->index();
            $table->enum('raised_by', ['client','freelancer']);
            $table->text('reason');
            $table->enum('status', ['open','resolved','rejected'])->default('open');
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onUpdate('no action')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disputes');
    }
};

