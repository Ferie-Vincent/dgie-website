{{-- Toast container — fixed top-right --}}
<div class="toast-container" id="toastContainer">
    @if(session('success'))
    <div class="toast toast--success" data-auto-dismiss>
        <div class="toast__icon">
            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <div class="toast__content">
            <div class="toast__title">Succès</div>
            <div class="toast__message">{{ session('success') }}</div>
        </div>
        <button class="toast__close" aria-label="Fermer">
            <svg viewBox="0 0 24 24" width="16" height="16"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
        <div class="toast__progress"></div>
    </div>
    @endif

    @if(session('error'))
    <div class="toast toast--error" data-auto-dismiss>
        <div class="toast__icon">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="toast__content">
            <div class="toast__title">Erreur</div>
            <div class="toast__message">{{ session('error') }}</div>
        </div>
        <button class="toast__close" aria-label="Fermer">
            <svg viewBox="0 0 24 24" width="16" height="16"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
        <div class="toast__progress"></div>
    </div>
    @endif

    @if(session('warning'))
    <div class="toast toast--warning" data-auto-dismiss>
        <div class="toast__icon">
            <svg viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div class="toast__content">
            <div class="toast__title">Attention</div>
            <div class="toast__message">{{ session('warning') }}</div>
        </div>
        <button class="toast__close" aria-label="Fermer">
            <svg viewBox="0 0 24 24" width="16" height="16"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
        <div class="toast__progress"></div>
    </div>
    @endif

    @if(session('info'))
    <div class="toast toast--info" data-auto-dismiss>
        <div class="toast__icon">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
        </div>
        <div class="toast__content">
            <div class="toast__title">Information</div>
            <div class="toast__message">{{ session('info') }}</div>
        </div>
        <button class="toast__close" aria-label="Fermer">
            <svg viewBox="0 0 24 24" width="16" height="16"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
        <div class="toast__progress"></div>
    </div>
    @endif

    @if($errors->any())
    <div class="toast toast--error" data-auto-dismiss>
        <div class="toast__icon">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="toast__content">
            <div class="toast__title">Erreur de validation</div>
            <div class="toast__message">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        </div>
        <button class="toast__close" aria-label="Fermer">
            <svg viewBox="0 0 24 24" width="16" height="16"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
        <div class="toast__progress"></div>
    </div>
    @endif
</div>
