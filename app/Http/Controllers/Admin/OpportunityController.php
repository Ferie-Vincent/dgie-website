<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OpportunityController extends Controller
{
    public function index(Request $request)
    {
        $query = Opportunity::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $opportunites = $query->latest()->paginate(15)->withQueryString();

        return view('back-end.opportunites.index', compact('opportunites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'type' => 'required|in:emploi,investissement,formation,bourse,appel_a_projets',
            'organisme' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'date_limite' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (Opportunity::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('opportunites', 'public');
        }

        Opportunity::create($validated);

        return redirect()->route('admin.opportunites.index')
            ->with('success', 'Opportunité créée avec succès.');
    }

    public function update(Request $request, Opportunity $opportunite)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'type' => 'required|in:emploi,investissement,formation,bourse,appel_a_projets',
            'organisme' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'date_limite' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('opportunites', 'public');
        }

        $opportunite->update($validated);

        return redirect()->route('admin.opportunites.index')
            ->with('success', 'Opportunité mise à jour avec succès.');
    }

    public function destroy(Opportunity $opportunite)
    {
        $opportunite->delete();

        return redirect()->route('admin.opportunites.index')
            ->with('success', 'Opportunité supprimée avec succès.');
    }
}
