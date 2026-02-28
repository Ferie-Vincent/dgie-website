<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Dossier;
use App\Models\Evenement;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q', '');

        if (strlen($query) < 3) {
            return view('front-end.pages.search', [
                'query' => $query,
                'articles' => collect(),
                'dossiers' => collect(),
                'evenements' => collect(),
            ]);
        }

        $articles = Article::published()
            ->with('category')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->take(12)
            ->get();

        $dossiers = Dossier::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->take(6)
            ->get();

        $evenements = Evenement::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->latest('event_date')
            ->take(6)
            ->get();

        return view('front-end.pages.search', compact('query', 'articles', 'dossiers', 'evenements'));
    }
}
