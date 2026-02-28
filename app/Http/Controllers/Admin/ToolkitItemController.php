<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ToolkitItem;
use Illuminate\Http\Request;

class ToolkitItemController extends Controller
{
    public function index(Request $request)
    {
        $query = ToolkitItem::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $items = $query->orderBy('order')->paginate(15)->withQueryString();

        return view('back-end.toolkit-items.index', compact('items'));
    }

    public function create()
    {
        return view('back-end.toolkit-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon_color' => 'nullable|string|max:50',
            'url' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        ToolkitItem::create($validated);

        return redirect()->route('admin.toolkit-items.index')
            ->with('success', 'Outil créé avec succès.');
    }

    public function edit(ToolkitItem $toolkit_item)
    {
        return view('back-end.toolkit-items.edit', compact('toolkit_item'));
    }

    public function update(Request $request, ToolkitItem $toolkit_item)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon_color' => 'nullable|string|max:50',
            'url' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $toolkit_item->update($validated);

        return redirect()->route('admin.toolkit-items.index')
            ->with('success', 'Outil mis à jour avec succès.');
    }

    public function destroy(ToolkitItem $toolkit_item)
    {
        $toolkit_item->delete();

        return redirect()->route('admin.toolkit-items.index')
            ->with('success', 'Outil supprimé avec succès.');
    }
}
