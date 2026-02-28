@extends('back-end.layouts.admin')

@section('title', 'Nouveau sondage')
@section('breadcrumb', 'Sondages / Créer')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Nouveau sondage</h1>
        <p class="content-subtitle">Créez un nouveau sondage avec ses options</p>
    </div>
    <a href="{{ route('admin.polls.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.polls.store') }}">
    @csrf

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="question">Question <span class="required">*</span></label>
                <input type="text" id="question" name="question" class="form-input" value="{{ old('question') }}" required placeholder="Votre question de sondage">
                @error('question') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="display:flex; align-items:end; padding-bottom: 4px;">
                <label>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="margin-right: 6px;">
                    Actif
                </label>
            </div>
        </div>

        {{-- Options section --}}
        <div style="margin-top: 24px; border-top: 1px solid var(--admin-border, #e5e7eb); padding-top: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <label style="font-weight: 600; font-size: 14px;">Options de réponse <span class="required">*</span></label>
                <button type="button" id="addOptionBtn" class="btn btn-outline" style="font-size: 13px; padding: 6px 12px;">
                    <svg viewBox="0 0 24 24" style="width: 14px; height: 14px;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Ajouter une option
                </button>
            </div>
            @error('options') <span class="form-error" style="display:block; margin-bottom: 12px;">{{ $message }}</span> @enderror
            @error('options.*') <span class="form-error" style="display:block; margin-bottom: 12px;">{{ $message }}</span> @enderror

            <div id="optionsContainer">
                @if(old('options'))
                    @foreach(old('options') as $i => $opt)
                    <div class="option-row" style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px;">
                        <input type="text" name="options[]" class="form-input" value="{{ $opt }}" required placeholder="Option {{ $i + 1 }}" style="flex: 1;">
                        <button type="button" class="action-btn delete remove-option-btn" title="Retirer" aria-label="Retirer" style="flex-shrink: 0;">
                            <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>
                    @endforeach
                @else
                    <div class="option-row" style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px;">
                        <input type="text" name="options[]" class="form-input" required placeholder="Option 1" style="flex: 1;">
                        <button type="button" class="action-btn delete remove-option-btn" title="Retirer" aria-label="Retirer" style="flex-shrink: 0;">
                            <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>
                    <div class="option-row" style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px;">
                        <input type="text" name="options[]" class="form-input" required placeholder="Option 2" style="flex: 1;">
                        <button type="button" class="action-btn delete remove-option-btn" title="Retirer" aria-label="Retirer" style="flex-shrink: 0;">
                            <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Enregistrer
            </button>
            <a href="{{ route('admin.polls.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('optionsContainer');
        const addBtn = document.getElementById('addOptionBtn');
        let optionCount = container.querySelectorAll('.option-row').length;

        addBtn.addEventListener('click', function() {
            optionCount++;
            const row = document.createElement('div');
            row.className = 'option-row';
            row.style.cssText = 'display: flex; gap: 8px; align-items: center; margin-bottom: 8px;';
            row.innerHTML = '<input type="text" name="options[]" class="form-input" required placeholder="Option ' + optionCount + '" style="flex: 1;">' +
                '<button type="button" class="action-btn delete remove-option-btn" title="Retirer" aria-label="Retirer" style="flex-shrink: 0;">' +
                '<svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>';
            container.appendChild(row);
            updateRemoveButtons();
        });

        container.addEventListener('click', function(e) {
            const btn = e.target.closest('.remove-option-btn');
            if (btn) {
                const rows = container.querySelectorAll('.option-row');
                if (rows.length > 2) {
                    btn.closest('.option-row').remove();
                    updateRemoveButtons();
                }
            }
        });

        function updateRemoveButtons() {
            const rows = container.querySelectorAll('.option-row');
            rows.forEach(function(row) {
                const btn = row.querySelector('.remove-option-btn');
                if (btn) {
                    btn.style.visibility = rows.length <= 2 ? 'hidden' : 'visible';
                }
            });
        }

        updateRemoveButtons();
    });
</script>
@endsection
