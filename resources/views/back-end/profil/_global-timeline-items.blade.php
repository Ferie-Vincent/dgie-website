@foreach($globalTimeline as $log)
<div class="tl-row">
    <span class="tl-dot tl-dot--{{ $log->action }}"></span>
    <span class="tl-icon">
        @switch($log->model_label)
            @case('Article')
                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                @break
            @case('Evenement')
                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg>
                @break
            @case('Dossier')
                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                @break
            @case('GalerieAlbum')
                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                @break
            @case('User')
                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                @break
            @default
                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        @endswitch
    </span>
    @if($log->user)
    <a href="{{ route('admin.profil.show', $log->user) }}" class="tl-user">
        @php
            $avatarBg = match($log->user->role) {
                'super-admin' => '#1e293b',
                'editeur' => '#1D8C4F',
                default => '#3b82f6',
            };
        @endphp
        <span class="tl-avatar" style="background: {{ $log->user->avatar ? 'transparent' : $avatarBg }};">
            @if($log->user->avatar)
                <img src="{{ asset('storage/' . $log->user->avatar) }}" alt="">
            @else
                {{ mb_substr($log->user->name, 0, 1) }}
            @endif
        </span>
        {{ $log->user->name }}
    </a>
    @endif
    <span class="tl-desc">{{ $log->description }}</span>
    <span class="tl-time">{{ $log->created_at->diffForHumans() }}</span>
    @if($log->ip_address)
    <span class="tl-ip">{{ $log->ip_address }}</span>
    @endif
</div>
@endforeach
