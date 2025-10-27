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
        Schema::create('project_levels', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->enum('account_type', ['seller', 'buyer']);
            $table->string('label');
            $table->string('badge_color')->nullable();
            $table->string('text_color')->nullable();
            $table->unsignedInteger('min_completed_projects')->default(0);
            $table->unsignedInteger('min_rating_count')->default(0);
            $table->decimal('min_rating', 5, 2)->default(0);
            $table->unsignedSmallInteger('priority')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_levels');
    }
};
