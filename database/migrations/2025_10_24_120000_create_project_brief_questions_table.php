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
        Schema::create('project_brief_questions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->unsignedBigInteger('project_id')->index();
            $table->string('question', 200);
            $table->boolean('is_required')->default(false);
            $table->unsignedTinyInteger('position')->default(1);
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
        Schema::dropIfExists('project_brief_questions');
    }
};
