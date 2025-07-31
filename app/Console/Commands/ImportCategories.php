<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoriesImport;

class ImportCategories extends Command
{
    protected $signature = 'import:categories {file}';
    protected $description = 'Import categories from an Excel file';

    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return Command::FAILURE;
        }

        try {
            Excel::import(new CategoriesImport, $file);
            $this->info("Categories imported successfully from {$file}");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Import failed: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}

