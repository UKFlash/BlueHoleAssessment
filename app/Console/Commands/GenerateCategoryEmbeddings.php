<?php

namespace App\Console\Commands;

use App\Helpers\Helpers;
use Illuminate\Console\Command;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use App\Models\CategoryEmbedding;

class GenerateCategoryEmbeddings extends Command
{
    protected $signature = 'categories:embed';
    protected $description = 'Generate and store vector embeddings for categories';

    public function handle()
    {
        $categories = Category::doesntHave('embedding')->get();

        foreach ($categories as $category) {
            $embedding = Helpers::getEmbedding($category->name);

            if ($embedding) {
                CategoryEmbedding::create([
                    'category_id' => $category->id,
                    'embedding' => $embedding,
                ]);

                $this->info("Embedded: {$category->name}");
            } else {
                $this->error("Failed: {$category->name}");
            }
        }

        return Command::SUCCESS;
    }
}
