<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $query = Banner::query();

        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }

        $banners = $query->orderBy('order')->paginate(15)->withQueryString();

        return view('back-end.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('back-end.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|max:5120',
            'url' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'position' => 'required|in:top,sidebar,popup,pub',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('banners', 'public');
        }

        Banner::create($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Bannière créée avec succès.');
    }

    public function edit(Banner $banner)
    {
        return view('back-end.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'url' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'position' => 'required|in:top,sidebar,popup,pub',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($validated);

        if ($request->input('_redirect') === 'dashboard') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Bannière publicitaire mise à jour.');
        }

        return redirect()->route('admin.banners.index')
            ->with('success', 'Bannière mise à jour avec succès.');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Bannière supprimée avec succès.');
    }
}
