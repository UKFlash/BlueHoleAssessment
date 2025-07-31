<?php

namespace App\Helpers;

class Helpers
{
    function cosineSimilarity(array $vecA, array $vecB)
    {
        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        for ($i = 0; $i < count($vecA); $i++) {
            $dotProduct += $vecA[$i] * $vecB[$i];
            $normA += $vecA[$i] ** 2;
            $normB += $vecB[$i] ** 2;
        }

        return $normA && $normB ? $dotProduct / (sqrt($normA) * sqrt($normB)) : 0;
    }
}