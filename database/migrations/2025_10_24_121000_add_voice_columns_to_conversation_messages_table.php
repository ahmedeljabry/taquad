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
        Schema::table('conversation_messages', function (Blueprint $table) {
            $table->string('type', 20)->default('text')->after('message_to');
            $table->string('attachment_path')->nullable()->after('type');
            $table->string('attachment_disk', 20)->nullable()->after('attachment_path');
            $table->unsignedInteger('attachment_duration')->nullable()->after('attachment_disk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conversation_messages', function (Blueprint $table) {
            $table->dropColumn(['type', 'attachment_path', 'attachment_disk', 'attachment_duration']);
        });
    }
};
