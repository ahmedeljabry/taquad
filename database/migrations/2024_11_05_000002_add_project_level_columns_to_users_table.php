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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('freelancer_project_level_id')->nullable()->after('level_id');
            $table->unsignedBigInteger('client_project_level_id')->nullable()->after('freelancer_project_level_id');
            $table->unsignedInteger('project_rating_count')->default(0)->after('balance_available');
            $table->unsignedInteger('project_rating_sum')->default(0)->after('project_rating_count');
            $table->decimal('project_rating_avg', 5, 2)->default(0)->after('project_rating_sum');
            $table->unsignedInteger('client_rating_count')->default(0)->after('project_rating_avg');
            $table->unsignedInteger('client_rating_sum')->default(0)->after('client_rating_count');
            $table->decimal('client_rating_avg', 5, 2)->default(0)->after('client_rating_sum');
            $table->timestamp('last_project_review_at')->nullable()->after('client_rating_avg');

            $table->foreign('freelancer_project_level_id')
                ->references('id')
                ->on('project_levels')
                ->nullOnDelete();

            $table->foreign('client_project_level_id')
                ->references('id')
                ->on('project_levels')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['freelancer_project_level_id']);
            $table->dropForeign(['client_project_level_id']);

            $table->dropColumn([
                'freelancer_project_level_id',
                'client_project_level_id',
                'project_rating_count',
                'project_rating_sum',
                'project_rating_avg',
                'client_rating_count',
                'client_rating_sum',
                'client_rating_avg',
                'last_project_review_at',
            ]);
        });
    }
};
