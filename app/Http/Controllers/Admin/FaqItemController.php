<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use App\Models\Dossier;
use Illuminate\Http\Request;

class FaqItemController extends Controller
{
    public function index(Request $request)
    {
        $query = FaqItem::query();

        if ($request->filled('search')) {
            $query->where('question', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('faqable_type', $request->type);
        }

        $faqs = $query->orderBy('order')->paginate(20)->withQueryString();
        $dossiers = Dossier::orderBy('title')->get();
        return view('back-end.faqs.index', compact('faqs', 'dossiers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'faqable_type' => 'nullable|string',
            'faqable_id' => 'nullable|integer',
            'order' => 'nullable|integer',
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        FaqItem::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ créée avec succès.');
    }

    public function edit(FaqItem $faq)
    {
        $dossiers = Dossier::orderBy('title')->get();
        return view('back-end.faqs.edit', compact('faq', 'dossiers'));
    }

    public function update(Request $request, FaqItem $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'faqable_type' => 'nullable|string',
            'faqable_id' => 'nullable|integer',
            'order' => 'nullable|integer',
        ]);

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ mise à jour.');
    }

    public function destroy(FaqItem $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ supprimée.');
    }
}
