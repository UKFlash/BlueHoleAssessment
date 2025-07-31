<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\CategoryEmbedding;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $results = [];

        if ($search) {
            $apiKey = config('services.openai.key');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])->post('https://api.openai.com/v1/embeddings', [
                'input' => $search,
                'model' => 'text-embedding-ada-002',
            ]);

            if ($response->successful()) {
                $queryVector = $response->json('data.0.embedding');

                $categories = CategoryEmbedding::with('category')->get();

                $scored = $categories->map(function ($item) use ($queryVector) {
                    $score = cosineSimilarity($queryVector, $item->embedding);
                    return [
                        'category' => $item->category,
                        'score' => $score,
                    ];
                });

                $results = $scored->sortByDesc('score')->take(5)->filter(fn($r) => $r['score'] > 0.7);
            }
        }

        return view('search', [
            'search' => $search,
            'results' => collect($results)
        ]);
    }
}
