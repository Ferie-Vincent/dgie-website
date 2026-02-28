<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::orderByDesc('published_at')->paginate(15);
        return view('back-end.magazines.index', compact('magazines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'cover_image' => 'required|image|max:5120',
            'pdf_file' => 'required|file|max:20480|mimes:pdf',
            'published_at' => 'nullable|date',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('magazines', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file'] = $request->file('pdf_file')->store('magazines/pdf', 'public');
        }

        Magazine::create($validated);

        return redirect()->route('admin.magazines.index')
            ->with('success', 'Magazine ajouté avec succès.');
    }

    public function edit(Magazine $magazine)
    {
        $magazines = Magazine::orderByDesc('published_at')->paginate(15);
        return view('back-end.magazines.index', compact('magazines', 'magazine'));
    }

    public function update(Request $request, Magazine $magazine)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'cover_image' => 'nullable|image|max:5120',
            'pdf_file' => 'nullable|file|max:20480|mimes:pdf',
            'published_at' => 'nullable|date',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('magazines', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file'] = $request->file('pdf_file')->store('magazines/pdf', 'public');
        }

        $magazine->update($validated);

        return redirect()->route('admin.magazines.index')
            ->with('success', 'Magazine mis à jour avec succès.');
    }

    public function destroy(Magazine $magazine)
    {
        $magazine->delete();

        return redirect()->route('admin.magazines.index')
            ->with('success', 'Magazine supprimé avec succès.');
    }
}
