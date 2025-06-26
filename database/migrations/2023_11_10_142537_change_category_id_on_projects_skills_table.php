<?php

use App\Models\ProjectSkill;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::table('projects_skills', function (Blueprint $table) {
            // $table->dropForeign(['category_id']);
            if (!Schema::hasColumn('projects_skills', 'category_id')) {
                $table->unsignedBigInteger('category_id');
            }
    
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('no action')
                  ->onUpdate('no action');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects_skills', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(ProjectSkill::class, 'category_id');
        });
    }
};
