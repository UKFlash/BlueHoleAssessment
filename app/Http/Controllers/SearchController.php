<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\CategoryEmbedding;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $results = collect();

        if ($search) {
            $searchVec = Helpers::getEmbedding($search);
            dd($search,$searchVec);
            if ($searchVec) {
                $embeddings = CategoryEmbedding::with('category')->get();

                $results = $embeddings->map(function ($embedding) use ($searchVec) {
                    $score = Helpers::cosine($searchVec, $embedding->embedding);
                    $embedding->category->score = $score;
                    return $embedding->category;
                })->sortByDesc('score')->filter(fn($c) => $c->score >= 0.5)->take(5);
            }
        }

        return view('search', compact('search', 'results'));
    }
}
