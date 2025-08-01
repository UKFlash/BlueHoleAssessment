<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class Helpers
{
    public static function getEmbedding(string $text): ?array
    {
        $apiUrl = 'https://api-inference.huggingface.co/embeddings/sentence-transformers/all-MiniLM-L6-v2';
        $apiToken = env('HF_API_TOKEN');

        $response = Http::withToken($apiToken)
            ->timeout(10)
            ->post($apiUrl, ['inputs' => $text]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    public static function cosine(array $vec1, array $vec2): float
    {
        $dotProduct = array_sum(array_map(fn($a, $b) => $a * $b, $vec1, $vec2));
        $magnitude1 = sqrt(array_sum(array_map(fn($x) => $x * $x, $vec1)));
        $magnitude2 = sqrt(array_sum(array_map(fn($x) => $x * $x, $vec2)));

        return ($magnitude1 * $magnitude2) == 0 ? 0 : $dotProduct / ($magnitude1 * $magnitude2);
    }
}
