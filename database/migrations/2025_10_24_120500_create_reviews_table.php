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
    public function up(): void
    {
        if (Schema::hasTable('reviews')) {
            return;
        }

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 20)->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('gig_id')->nullable();
            $table->unsignedBigInteger('order_item_id')->nullable();
            $table->unsignedTinyInteger('rating');
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'published', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('seller_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('gig_id')
                ->references('id')
                ->on('gigs')
                ->nullOnDelete();

            $table->foreign('order_item_id')
                ->references('id')
                ->on('order_items')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
