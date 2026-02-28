<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashInfo;
use Illuminate\Http\Request;

class FlashInfoController extends Controller
{
    public function index()
    {
        $flashInfos = FlashInfo::orderBy('order')->get();
        return view('back-end.flash-infos.index', compact('flashInfos'));
    }

    public function create()
    {
        return view('back-end.flash-infos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        FlashInfo::create($validated);

        return redirect()->route('admin.flash-infos.index')
            ->with('success', 'Flash info créé avec succès.');
    }

    public function edit(FlashInfo $flash_info)
    {
        return view('back-end.flash-infos.edit', compact('flash_info'));
    }

    public function update(Request $request, FlashInfo $flash_info)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $flash_info->update($validated);

        return redirect()->route('admin.flash-infos.index')
            ->with('success', 'Flash info mis à jour avec succès.');
    }

    public function destroy(FlashInfo $flash_info)
    {
        $flash_info->delete();

        return redirect()->route('admin.flash-infos.index')
            ->with('success', 'Flash info supprimé avec succès.');
    }
}
