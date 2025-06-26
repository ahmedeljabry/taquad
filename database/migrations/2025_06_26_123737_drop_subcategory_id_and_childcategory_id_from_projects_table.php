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
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['childcategory_id']);
            $table->dropColumn(['subcategory_id', 'childcategory_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('subcategory_id')->nullable()->after('category_id');
            $table->unsignedBigInteger('childcategory_id')->nullable()->after('subcategory_id');

            $table->foreign('subcategory_id')->references('id')->on('projects_categories')->onDelete('cascade');
            $table->foreign('childcategory_id')->references('id')->on('projects_categories')->onDelete('cascade');
        });
    }
};
