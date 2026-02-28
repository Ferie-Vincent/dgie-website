<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('order')->paginate(15);

        return view('back-end.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('back-end.departments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'acronym' => 'required|max:20',
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'link' => 'nullable|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Department::create($validated);

        return redirect()->route('admin.departments.index')
            ->with('success', 'Sous-direction créée avec succès.');
    }

    public function edit(Department $department)
    {
        return view('back-end.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'acronym' => 'required|max:20',
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'link' => 'nullable|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $department->update($validated);

        return redirect()->route('admin.departments.index')
            ->with('success', 'Sous-direction mise à jour avec succès.');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('admin.departments.index')
            ->with('success', 'Sous-direction supprimée avec succès.');
    }
}
