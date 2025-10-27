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
        Schema::table('project_milestones', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_milestone_id')->nullable()->after('description');
            $table->boolean('is_follow_up')->default(false)->after('parent_milestone_id');

            $table->foreign('parent_milestone_id')
                ->references('id')
                ->on('project_milestones')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_milestones', function (Blueprint $table) {
            $table->dropForeign(['parent_milestone_id']);
            $table->dropColumn(['parent_milestone_id', 'is_follow_up']);
        });
    }
};
