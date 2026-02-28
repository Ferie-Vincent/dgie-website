<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index(Request $request)
    {
        $query = Evenement::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('section')) {
            $query->where('section', $request->section);
        }

        $evenements = $query->latest('event_date')->paginate(15)->withQueryString();

        // Prochain événement à venir (publié, date future, le plus proche)
        $nextEvent = Evenement::where('status', 'publie')
            ->where('event_date', '>', now())
            ->orderBy('event_date')
            ->first();

        // Événements passés (date < maintenant)
        $pastEvents = Evenement::where('status', 'publie')
            ->where('event_date', '<', now())
            ->orderByDesc('event_date')
            ->take(6)
            ->get();

        return view('back-end.evenements.index', compact('evenements', 'nextEvent', 'pastEvents'));
    }

    public function create()
    {
        return view('back-end.evenements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:event_date',
            'is_featured' => 'boolean',
            'status' => 'required|in:brouillon,publie,archive',
            'section' => 'required|in:general,diaspora',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('evenements', 'public');
        }

        Evenement::create($validated);

        return redirect()->route('admin.evenements.index')
            ->with('success', 'Événement créé avec succès.');
    }

    public function edit(Evenement $evenement)
    {
        return view('back-end.evenements.edit', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:event_date',
            'is_featured' => 'boolean',
            'status' => 'required|in:brouillon,publie,archive',
            'section' => 'required|in:general,diaspora',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('evenements', 'public');
        }

        $evenement->update($validated);

        return redirect()->route('admin.evenements.index')
            ->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(Evenement $evenement)
    {
        $evenement->delete();

        return redirect()->route('admin.evenements.index')
            ->with('success', 'Événement supprimé avec succès.');
    }
}
