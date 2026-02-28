<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CulturalItem;
use Illuminate\Http\Request;

class CulturalItemController extends Controller
{
    public function index(Request $request)
    {
        $query = CulturalItem::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $items = $query->orderBy('order')->paginate(15)->withQueryString();

        return view('back-end.cultural-items.index', compact('items'));
    }

    public function create()
    {
        return view('back-end.cultural-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:musique,livre,film,gastronomie',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cultural', 'public');
        }

        CulturalItem::create($validated);

        return redirect()->route('admin.cultural-items.index')
            ->with('success', 'Contenu culturel créé avec succès.');
    }

    public function edit(CulturalItem $cultural_item)
    {
        return view('back-end.cultural-items.edit', compact('cultural_item'));
    }

    public function update(Request $request, CulturalItem $cultural_item)
    {
        $validated = $request->validate([
            'type' => 'required|in:musique,livre,film,gastronomie',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cultural', 'public');
        }

        $cultural_item->update($validated);

        return redirect()->route('admin.cultural-items.index')
            ->with('success', 'Contenu culturel mis à jour avec succès.');
    }

    public function destroy(CulturalItem $cultural_item)
    {
        $cultural_item->delete();

        return redirect()->route('admin.cultural-items.index')
            ->with('success', 'Contenu culturel supprimé avec succès.');
    }
}
