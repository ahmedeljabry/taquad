<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 20)->unique();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('milestone_id')->nullable();
            $table->unsignedBigInteger('reviewer_id');
            $table->unsignedBigInteger('reviewee_id');
            $table->enum('reviewer_role', ['client', 'freelancer']);
            $table->unsignedTinyInteger('score')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('is_skipped')->default(false);
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->foreign('milestone_id')->references('id')->on('project_milestones')->nullOnDelete();
            $table->foreign('reviewer_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('reviewee_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unique(['project_id', 'reviewer_id', 'reviewer_role'], 'project_reviews_unique_review');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_reviews');
    }
};
