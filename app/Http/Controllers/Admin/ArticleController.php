<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('category', 'author');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('section')) {
            $query->where('section', $request->section);
        }

        $articles = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $dossiers = \App\Models\Dossier::orderBy('title')->get();

        return view('back-end.articles.index', compact('articles', 'categories', 'dossiers'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('back-end.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'dossier_id' => 'nullable|exists:dossiers,id',
            'status' => 'required|in:brouillon,publie,archive',
            'section' => 'required|in:retour,investir,action-sociale',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['author_id'] = auth()->id();
                $validated['read_time'] = max(1, (int) ceil(str_word_count(strip_tags($validated['content'])) / 200));

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        if ($validated['status'] === 'publie' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article créé avec succès.');
    }

    public function show(Article $article)
    {
        $article->load('category', 'author', 'comments');
        return view('back-end.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::orderBy('name')->get();
        return view('back-end.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'dossier_id' => 'nullable|exists:dossiers,id',
            'status' => 'required|in:brouillon,publie,archive',
            'section' => 'required|in:retour,investir,action-sociale',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
                $validated['read_time'] = max(1, (int) ceil(str_word_count(strip_tags($validated['content'])) / 200));

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        if ($validated['status'] === 'publie' && !$article->published_at && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article supprimé avec succès.');
    }
}
