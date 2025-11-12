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
        // Time Entries indexes for better query performance
        Schema::table('time_entries', function (Blueprint $table) {
            $table->index(['contract_id', 'started_at'], 'idx_time_entries_contract_started');
            $table->index(['synced_at'], 'idx_time_entries_synced');
            $table->index(['invoice_id'], 'idx_time_entries_invoice');
            $table->index(['user_id', 'created_at'], 'idx_time_entries_user_created');
            $table->index(['status'], 'idx_time_entries_status');
            $table->index(['billing_status'], 'idx_time_entries_billing_status');
            $table->index(['client_status', 'contract_id'], 'idx_time_entries_client_status_contract');
        });

        // Time Snapshots indexes
        Schema::table('time_snapshots', function (Blueprint $table) {
            $table->index(['time_entry_id'], 'idx_time_snapshots_entry');
            $table->index(['captured_at'], 'idx_time_snapshots_captured');
        });

        // Contracts indexes
        Schema::table('contracts', function (Blueprint $table) {
            $table->index(['status'], 'idx_contracts_status');
            $table->index(['client_id', 'status'], 'idx_contracts_client_status');
            $table->index(['freelancer_id', 'status'], 'idx_contracts_freelancer_status');
            $table->index(['project_id'], 'idx_contracts_project');
            $table->index(['tracker_project_id'], 'idx_contracts_tracker_project');
            $table->index(['created_at'], 'idx_contracts_created');
        });

        // Invoices indexes
        Schema::table('invoices', function (Blueprint $table) {
            $table->index(['contract_id', 'week_start_date'], 'idx_invoices_contract_week');
            $table->index(['status'], 'idx_invoices_status');
            $table->index(['week_start_date', 'week_end_date'], 'idx_invoices_date_range');
            $table->index(['created_at'], 'idx_invoices_created');
        });

        // Proposals indexes
        Schema::table('proposals', function (Blueprint $table) {
            $table->index(['project_id', 'status'], 'idx_proposals_project_status');
            $table->index(['freelancer_id', 'status'], 'idx_proposals_freelancer_status');
            $table->index(['status'], 'idx_proposals_status');
            $table->index(['created_at'], 'idx_proposals_created');
        });

        // Projects indexes
        Schema::table('projects', function (Blueprint $table) {
            $table->index(['user_id', 'status'], 'idx_projects_user_status');
            $table->index(['budget_type'], 'idx_projects_budget_type');
            $table->index(['status', 'created_at'], 'idx_projects_status_created');
        });

        // Payments indexes (if table exists)
        if (Schema::hasTable('payments')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->index(['invoice_id'], 'idx_payments_invoice');
                $table->index(['contract_id'], 'idx_payments_contract');
                $table->index(['payer_id'], 'idx_payments_payer');
                $table->index(['payee_id'], 'idx_payments_payee');
                $table->index(['status'], 'idx_payments_status');
                $table->index(['paid_at'], 'idx_payments_paid_at');
                $table->index(['released_at'], 'idx_payments_released_at');
            });
        }

        // Disputes indexes
        Schema::table('disputes', function (Blueprint $table) {
            $table->index(['invoice_id'], 'idx_disputes_invoice');
            $table->index(['contract_id'], 'idx_disputes_contract');
            $table->index(['raised_by'], 'idx_disputes_raised_by');
            $table->index(['status'], 'idx_disputes_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Time Entries
        Schema::table('time_entries', function (Blueprint $table) {
            $table->dropIndex('idx_time_entries_contract_started');
            $table->dropIndex('idx_time_entries_synced');
            $table->dropIndex('idx_time_entries_invoice');
            $table->dropIndex('idx_time_entries_user_created');
            $table->dropIndex('idx_time_entries_status');
            $table->dropIndex('idx_time_entries_billing_status');
            $table->dropIndex('idx_time_entries_client_status_contract');
        });

        // Time Snapshots
        Schema::table('time_snapshots', function (Blueprint $table) {
            $table->dropIndex('idx_time_snapshots_entry');
            $table->dropIndex('idx_time_snapshots_captured');
        });

        // Contracts
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropIndex('idx_contracts_status');
            $table->dropIndex('idx_contracts_client_status');
            $table->dropIndex('idx_contracts_freelancer_status');
            $table->dropIndex('idx_contracts_project');
            $table->dropIndex('idx_contracts_tracker_project');
            $table->dropIndex('idx_contracts_created');
        });

        // Invoices
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropIndex('idx_invoices_contract_week');
            $table->dropIndex('idx_invoices_status');
            $table->dropIndex('idx_invoices_date_range');
            $table->dropIndex('idx_invoices_created');
        });

        // Proposals
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropIndex('idx_proposals_project_status');
            $table->dropIndex('idx_proposals_freelancer_status');
            $table->dropIndex('idx_proposals_status');
            $table->dropIndex('idx_proposals_created');
        });

        // Projects
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex('idx_projects_user_status');
            $table->dropIndex('idx_projects_budget_type');
            $table->dropIndex('idx_projects_status_created');
        });

        // Payments
        if (Schema::hasTable('payments')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->dropIndex('idx_payments_invoice');
                $table->dropIndex('idx_payments_contract');
                $table->dropIndex('idx_payments_payer');
                $table->dropIndex('idx_payments_payee');
                $table->dropIndex('idx_payments_status');
                $table->dropIndex('idx_payments_paid_at');
                $table->dropIndex('idx_payments_released_at');
            });
        }

        // Disputes
        Schema::table('disputes', function (Blueprint $table) {
            $table->dropIndex('idx_disputes_invoice');
            $table->dropIndex('idx_disputes_contract');
            $table->dropIndex('idx_disputes_raised_by');
            $table->dropIndex('idx_disputes_status');
        });
    }
};

