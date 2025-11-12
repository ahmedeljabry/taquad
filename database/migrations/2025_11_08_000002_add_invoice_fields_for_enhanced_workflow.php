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
        Schema::table('invoices', function (Blueprint $table) {
            // Add fields for enhanced invoice workflow
            if (!Schema::hasColumn('invoices', 'subtotal')) {
                $table->decimal('subtotal', 10, 2)->nullable()->after('total_amount');
            }
            if (!Schema::hasColumn('invoices', 'platform_fee')) {
                $table->decimal('platform_fee', 10, 2)->default(0)->after('subtotal');
            }
            if (!Schema::hasColumn('invoices', 'tax_amount')) {
                $table->decimal('tax_amount', 10, 2)->default(0)->after('platform_fee');
            }
            if (!Schema::hasColumn('invoices', 'freelancer_amount')) {
                $table->decimal('freelancer_amount', 10, 2)->nullable()->after('tax_amount');
            }
            if (!Schema::hasColumn('invoices', 'currency_code')) {
                $table->string('currency_code', 3)->default('USD')->after('freelancer_amount');
            }
            if (!Schema::hasColumn('invoices', 'reviewed_at')) {
                $table->timestamp('reviewed_at')->nullable()->after('status');
            }
            if (!Schema::hasColumn('invoices', 'reviewed_by')) {
                $table->unsignedBigInteger('reviewed_by')->nullable()->after('reviewed_at');
            }
            if (!Schema::hasColumn('invoices', 'review_notes')) {
                $table->text('review_notes')->nullable()->after('reviewed_by');
            }
            if (!Schema::hasColumn('invoices', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('review_notes');
            }
        });

        // Create payments table if it doesn't exist
        if (!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('invoice_id');
                $table->unsignedBigInteger('contract_id');
                $table->unsignedBigInteger('payer_id'); // Client
                $table->unsignedBigInteger('payee_id'); // Freelancer
                $table->decimal('amount', 10, 2);
                $table->decimal('platform_fee', 10, 2)->default(0);
                $table->decimal('freelancer_amount', 10, 2);
                $table->string('currency_code', 3)->default('USD');
                $table->string('payment_method')->nullable();
                $table->string('transaction_id')->nullable();
                $table->string('status')->default('pending'); // pending, completed, failed, released
                $table->timestamp('paid_at')->nullable();
                $table->timestamp('released_at')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();

                $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
                $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
                $table->foreign('payer_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('payee_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'subtotal',
                'platform_fee',
                'tax_amount',
                'freelancer_amount',
                'currency_code',
                'reviewed_at',
                'reviewed_by',
                'review_notes',
                'paid_at',
            ]);
        });

        Schema::dropIfExists('payments');
    }
};

