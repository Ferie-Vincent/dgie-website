<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        $articles = $query->with('images')->latest()->paginate(15)->withQueryString();
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
            'additional_images' => 'nullable|array|max:10',
            'additional_images.*' => 'image|max:5120',
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (Article::withTrashed()->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $validated['slug'] = $slug;

        $validated['author_id'] = auth()->id();
        $validated['read_time'] = max(1, (int) ceil(str_word_count(strip_tags($validated['content'])) / 200));

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        if ($validated['status'] === 'publie' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        unset($validated['additional_images']);
        $article = Article::create($validated);

        if ($request->hasFile('additional_images')) {
            $order = 0;
            foreach ($request->file('additional_images') as $file) {
                $path = $file->store('articles/gallery', 'public');
                ArticleImage::create([
                    'article_id' => $article->id,
                    'image_path' => $path,
                    'order' => $order++,
                ]);
            }
        }

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
            'additional_images' => 'nullable|array|max:10',
            'additional_images.*' => 'image|max:5120',
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (Article::withTrashed()->where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $validated['slug'] = $slug;

        $validated['read_time'] = max(1, (int) ceil(str_word_count(strip_tags($validated['content'])) / 200));

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        if ($validated['status'] === 'publie' && !$article->published_at && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        unset($validated['additional_images']);
        $article->update($validated);

        if ($request->hasFile('additional_images')) {
            $maxOrder = $article->images()->max('order') ?? -1;
            foreach ($request->file('additional_images') as $file) {
                $path = $file->store('articles/gallery', 'public');
                ArticleImage::create([
                    'article_id' => $article->id,
                    'image_path' => $path,
                    'order' => ++$maxOrder,
                ]);
            }
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article mis à jour avec succès.');
    }

    public function destroyImage(ArticleImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return response()->json(['success' => true]);
    }

    public function destroy(Article $article)
    {
        foreach ($article->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }
        $article->images()->delete();
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article supprimé avec succès.');
    }
}
