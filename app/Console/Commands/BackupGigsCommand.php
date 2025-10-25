<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BackupGigsCommand extends Command
{
    protected $signature = 'gigs:backup {--path= : Optional subfolder name under storage/app/backups}';
    protected $description = 'Export gig-related tables to CSV files in storage/app/backups';

    protected array $tables = [
        // Core gig tables
        'gigs',
        'gig_visits',
        'gig_faqs',
        'gig_requirements',
        'gig_requirement_options',
        'gig_upgrades',
        'gig_seo',
        'gig_images',
        'gig_documents',
        'reported_gigs',
        // Dependent tables (orders/favorites/reviews)
        'favorites',
        'reviews',
        'orders',
        'order_items',
        'order_item_upgrades',
        'order_item_requirements',
        'order_item_work',
        'order_item_work_conversation',
        'order_invoice',
    ];

    public function handle(): int
    {
        $timestamp = now()->format('Ymd_His');
        $base = 'backups/'.($this->option('path') ?: ('gigs_'.$timestamp));
        $disk = Storage::disk('local');

        if (!$disk->exists($base)) {
            $disk->makeDirectory($base);
        }

        foreach ($this->tables as $table) {
            if (!$this->tableExists($table)) {
                $this->warn("Skip: table '{$table}' not found");
                continue;
            }

            $this->info("Exporting {$table} ...");
            $data = DB::table($table)->orderBy('id')->get();
            if ($data->isEmpty()) {
                $disk->put("{$base}/{$table}.csv", "");
                continue;
            }

            $headers = array_keys((array)$data->first());
            $csv = implode(',', array_map(fn($h) => '"'.str_replace('"', '""', $h).'"', $headers))."\n";
            foreach ($data as $row) {
                $line = [];
                foreach ($headers as $h) {
                    $val = (string) data_get($row, $h);
                    $line[] = '"'.str_replace('"', '""', $val).'"';
                }
                $csv .= implode(',', $line)."\n";
            }
            $disk->put("{$base}/{$table}.csv", $csv);
        }

        $this->info("Backup complete in storage/app/{$base}");
        return Command::SUCCESS;
    }

    protected function tableExists(string $table): bool
    {
        try {
            DB::table($table)->select(DB::raw('1'))->limit(1)->get();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}

