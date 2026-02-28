<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Dossier;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('quote', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $testimonials = $query->latest()->paginate(15)->withQueryString();
        $dossiers = Dossier::orderBy('title')->get();
        return view('back-end.testimonials.index', compact('testimonials', 'dossiers'));
    }

    public function create()
    {
        $dossiers = Dossier::orderBy('title')->get();
        return view('back-end.testimonials.create', compact('dossiers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'context' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'return_year' => 'nullable|string|max:10',
            'quote' => 'required|string',
            'page_slug' => 'nullable|string|max:255',
            'dossier_id' => 'nullable|exists:dossiers,id',
            'type' => 'required|in:general,retour,success_story',
            'avatar' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Témoignage créé avec succès.');
    }

    public function edit(Testimonial $testimonial)
    {
        $dossiers = Dossier::orderBy('title')->get();
        return view('back-end.testimonials.edit', compact('testimonial', 'dossiers'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'context' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'return_year' => 'nullable|string|max:10',
            'quote' => 'required|string',
            'page_slug' => 'nullable|string|max:255',
            'dossier_id' => 'nullable|exists:dossiers,id',
            'type' => 'required|in:general,retour,success_story',
            'avatar' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Témoignage mis à jour avec succès.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Témoignage supprimé avec succès.');
    }
}
