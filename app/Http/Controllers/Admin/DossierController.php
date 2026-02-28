<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DossierController extends Controller
{
    public function index()
    {
        $dossiers = Dossier::latest()->paginate(15);
        return view('back-end.dossiers.index', compact('dossiers'));
    }

    public function create()
    {
        return view('back-end.dossiers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'department' => 'nullable|in:DAOSAR,DMCRIE,DAS,DGIE',
            'status' => 'required|in:brouillon,publie,archive',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('dossiers', 'public');
        }

        Dossier::create($validated);

        return redirect()->route('admin.dossiers.index')
            ->with('success', 'Dossier créé avec succès.');
    }

    public function edit(Dossier $dossier)
    {
        return view('back-end.dossiers.edit', compact('dossier'));
    }

    public function update(Request $request, Dossier $dossier)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'department' => 'nullable|in:DAOSAR,DMCRIE,DAS,DGIE',
            'status' => 'required|in:brouillon,publie,archive',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('dossiers', 'public');
        }

        $dossier->update($validated);

        return redirect()->route('admin.dossiers.index')
            ->with('success', 'Dossier mis à jour avec succès.');
    }

    public function destroy(Dossier $dossier)
    {
        $dossier->delete();

        return redirect()->route('admin.dossiers.index')
            ->with('success', 'Dossier supprimé avec succès.');
    }
}
