@extends('back-end.layouts.admin')

@section('title', 'Modifier la FAQ')
@section('breadcrumb', 'FAQ / Modifier')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Modifier la FAQ</h1>
        <p class="content-subtitle">{{ Str::limit($faq->question, 50) }}</p>
    </div>
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
    @csrf
    @method('PUT')

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group">
                <label for="faqable_type">Type de parent <span class="required">*</span></label>
                <select id="faqable_type" name="faqable_type" class="form-select">
                    <option value="">-- Sélectionner --</option>
                    <option value="App\Models\Dossier" {{ old('faqable_type', $faq->faqable_type) == 'App\Models\Dossier' ? 'selected' : '' }}>Dossier</option>
                </select>
                @error('faqable_type') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" id="dossiers-group" style="display:none;">
                <label for="faqable_id_dossier">Dossier <span class="required">*</span></label>
                <select id="faqable_id_dossier" name="" class="form-select">
                    <option value="">-- Sélectionner un dossier --</option>
                    @foreach($dossiers as $dossier)
                        <option value="{{ $dossier->id }}" {{ old('faqable_id', $faq->faqable_type == 'App\Models\Dossier' ? $faq->faqable_id : '') == $dossier->id ? 'selected' : '' }}>{{ $dossier->title }}</option>
                    @endforeach
                </select>
                @error('faqable_id') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="order">Ordre</label>
                <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $faq->order) }}" min="0">
                @error('order') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label for="question">Question <span class="required">*</span></label>
                <textarea id="question" name="question" class="form-textarea" rows="3" required>{{ old('question', $faq->question) }}</textarea>
                @error('question') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label for="answer">Réponse <span class="required">*</span></label>
                <textarea id="answer" name="answer" class="form-textarea wysiwyg" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
                @error('answer') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Mettre à jour
            </button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    const typeSelect = document.getElementById('faqable_type');
    const dossiersGroup = document.getElementById('dossiers-group');
    const dossierSelect = document.getElementById('faqable_id_dossier');

    function toggleFaqableSelects() {
        const val = typeSelect.value;

        if (val === 'App\\Models\\Dossier') {
            dossiersGroup.style.display = '';
            dossierSelect.name = 'faqable_id';
        } else {
            dossiersGroup.style.display = 'none';
            dossierSelect.name = '';
        }
    }

    typeSelect.addEventListener('change', toggleFaqableSelects);
    // Initialize on page load (for old() values or existing data)
    toggleFaqableSelects();
</script>
@endsection
