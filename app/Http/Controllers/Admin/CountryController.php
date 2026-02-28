<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $query = Country::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $countries = $query->orderBy('order')->paginate(15)->withQueryString();

        return view('back-end.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('back-end.countries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'flag_emoji' => 'nullable|max:10',
            'population_label' => 'nullable|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Country::create($validated);

        return redirect()->route('admin.countries.index')
            ->with('success', 'Pays créé avec succès.');
    }

    public function edit(Country $country)
    {
        return view('back-end.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'flag_emoji' => 'nullable|max:10',
            'population_label' => 'nullable|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $country->update($validated);

        return redirect()->route('admin.countries.index')
            ->with('success', 'Pays mis à jour avec succès.');
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('admin.countries.index')
            ->with('success', 'Pays supprimé avec succès.');
    }
}
