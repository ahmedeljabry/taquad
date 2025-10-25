<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_brief_attachments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->unsignedBigInteger('project_id')->index();
            $table->string('original_name', 160);
            $table->string('stored_name', 160);
            $table->string('disk', 32)->default('public');
            $table->string('path', 255);
            $table->unsignedBigInteger('size')->default(0);
            $table->string('mime_type', 64)->nullable();
            $table->timestamps();

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_brief_attachments');
    }
};
