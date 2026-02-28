<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $documents = $query->orderBy('order')->paginate(15)->withQueryString();
        return view('back-end.documents.index', compact('documents'));
    }

    public function create()
    {
        return view('back-end.documents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv',
            'type' => 'required|in:juridique,rapport,organigramme,autre',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $file = $request->file('file');
        $validated['file_path'] = $file->store('documents', 'public');
        $validated['file_size'] = $this->formatFileSize($file->getSize());

        unset($validated['file']);

        Document::create($validated);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Document créé avec succès.');
    }

    public function edit(Document $document)
    {
        return view('back-end.documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv',
            'type' => 'required|in:juridique,rapport,organigramme,autre',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('file')) {
            // Supprimer l'ancien fichier
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }

            $file = $request->file('file');
            $validated['file_path'] = $file->store('documents', 'public');
            $validated['file_size'] = $this->formatFileSize($file->getSize());
        }

        unset($validated['file']);

        $document->update($validated);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Document mis à jour avec succès.');
    }

    public function destroy(Document $document)
    {
        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('admin.documents.index')
            ->with('success', 'Document supprimé avec succès.');
    }

    private function formatFileSize(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 1) . ' MB';
        } elseif ($bytes >= 1024) {
            return round($bytes / 1024, 1) . ' KB';
        }
        return $bytes . ' B';
    }
}
