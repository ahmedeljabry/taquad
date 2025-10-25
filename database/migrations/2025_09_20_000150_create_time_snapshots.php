<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_snapshots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('time_entry_id')->index();
            $table->string('image_path');
            $table->timestamp('captured_at');
            $table->timestamps();

            $table->foreign('time_entry_id')->references('id')->on('time_entries')->onUpdate('no action')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_snapshots');
    }
};

