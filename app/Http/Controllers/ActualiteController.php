<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount(['articles' => fn($q) => $q->published()])->get();

        $articles = Article::published()
            ->with('category')
            ->when($request->categorie, fn($q, $cat) => $q->whereHas('category', fn($c) => $c->where('slug', $cat)))
            ->when($request->section, fn($q, $section) => $q->where('section', $section))
            ->when($request->q, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->when($request->date_from, fn($q, $date) => $q->whereDate('published_at', '>=', $date))
            ->when($request->date_to, fn($q, $date) => $q->whereDate('published_at', '<=', $date))
            ->latest('published_at')
            ->paginate(12);

        $sectionLabels = [
            'retour' => 'Retour et Réintégration',
            'investir' => 'Investir et Contribuer',
            'action-sociale' => 'Actions Sociales',
        ];
        $currentSection = $request->section;
        $sectionLabel = $sectionLabels[$currentSection] ?? null;

        return view('front-end.pages.actualites', compact('articles', 'categories', 'currentSection', 'sectionLabel'));
    }

    public function show(string $slug)
    {
        $article = Article::published()
            ->where('slug', $slug)
            ->with([
                'category',
                'author',
                'images',
                'comments' => fn($q) => $q->approved()->whereNull('parent_id')->with(['replies' => fn($r) => $r->approved()]),
            ])
            ->firstOrFail();

        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest('published_at')
            ->take(4)
            ->get();

        $date = $article->published_at ?? $article->created_at;

        $previousArticle = Article::published()
            ->where('published_at', '<', $date)
            ->latest('published_at')
            ->first();

        $nextArticle = Article::published()
            ->where('published_at', '>', $date)
            ->oldest('published_at')
            ->first();

        return view('front-end.pages.article', compact('article', 'relatedArticles', 'previousArticle', 'nextArticle'));
    }
}
