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
            $table->boolean('requires_nda')->default(false)->after('is_alert');
            $table->string('nda_path')->nullable()->after('requires_nda');
            $table->unsignedSmallInteger('nda_term_months')->nullable()->after('nda_path');
            $table->text('nda_scope')->nullable()->after('nda_term_months');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['requires_nda', 'nda_path', 'nda_term_months', 'nda_scope']);
        });
    }
};
