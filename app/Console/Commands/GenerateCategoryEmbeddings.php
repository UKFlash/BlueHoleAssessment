<?php

namespace App\Console\Commands;

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
        $categories = Category::all();
        $apiKey = config('services.openai.key');

        foreach ($categories as $category) {
            $response = Http::withToken($apiKey)->post('https://api.openai.com/v1/embeddings', [
                'input' => $category->name,
                'model' => 'text-embedding-ada-002',
            ]);

            if ($response->successful()) {
                $embedding = $response->json('data.0.embedding');

                CategoryEmbedding::updateOrCreate(
                    ['category_id' => $category->id],
                    ['embedding' => $embedding]
                );

                $this->info("Embedded: {$category->name}");
            } else {
                $this->error("Failed: {$category->name}");
            }
        }

        return Command::SUCCESS;
    }
}
