<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $query = Staff::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $staff = $query->orderBy('order')->paginate(15)->withQueryString();

        return view('back-end.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('back-end.staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'type' => 'required|in:ministre,dg,directeur,autre',
            'quote' => 'nullable|string|max:1000',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'photo_page' => 'nullable|image|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('staff', 'public');
        }
        if ($request->hasFile('photo_page')) {
            $validated['photo_page'] = $request->file('photo_page')->store('staff', 'public');
        }

        Staff::create($validated);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Membre du personnel créé avec succès.');
    }

    public function edit(Staff $staff)
    {
        return view('back-end.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'type' => 'required|in:ministre,dg,directeur,autre',
            'quote' => 'nullable|string|max:1000',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'photo_page' => 'nullable|image|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('staff', 'public');
        }
        if ($request->hasFile('photo_page')) {
            $validated['photo_page'] = $request->file('photo_page')->store('staff', 'public');
        }

        $staff->update($validated);

        $redirect = $request->input('_redirect', 'staff');
        if ($redirect === 'dashboard') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Portrait mis à jour avec succès.');
        }

        return redirect()->route('admin.staff.index')
            ->with('success', 'Membre du personnel mis à jour avec succès.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('admin.staff.index')
            ->with('success', 'Membre du personnel supprimé avec succès.');
    }
}
