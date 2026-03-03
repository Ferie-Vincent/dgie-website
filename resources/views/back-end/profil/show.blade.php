@extends('back-end.layouts.admin')

@section('title', 'Profil de ' . $user->name)
@section('breadcrumb', 'Profil')

@section('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
@endsection

@section('content')

{{-- HERO SECTION --}}
<div class="profil-hero">
    <div class="profil-hero__bg"></div>
    <div class="profil-hero__content">
        <div class="profil-hero__avatar-wrapper">
            <div class="profil-hero__avatar" id="profileAvatar">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" id="avatarImg">
                @else
                    <span class="profil-hero__initials">{{ $user->initials }}</span>
                @endif
            </div>
            @if($isOwnProfile)
            <label class="profil-hero__avatar-overlay" for="avatarInput" title="Changer l'avatar">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                <span>Changer</span>
            </label>
            <input type="file" id="avatarInput" accept="image/jpeg,image/png,image/webp" style="display:none;" onchange="uploadAvatar(this)">
            @endif
        </div>
        <div class="profil-hero__info">
            <div class="profil-hero__name-row">
                <h1 class="profil-hero__name" id="heroName">{{ $user->name }}</h1>
                @if($isOwnProfile)
                <button class="profil-hero__edit-btn" onclick="toggleEditForm()" title="Modifier le profil">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/></svg>
                    Modifier
                </button>
                @endif
            </div>
            <div class="profil-hero__meta">
                @php
                    $roleClass = match($user->role) {
                        'super-admin' => 'superadmin',
                        'editeur' => 'editeur',
                        'redacteur' => 'redacteur',
                        default => 'redacteur',
                    };
                @endphp
                <span class="usr-role-badge {{ $roleClass }}">{{ $user->getRoleLabel() }}</span>
                <span class="profil-hero__email" id="heroEmail">{{ $user->email }}</span>
            </div>
            <div class="profil-hero__dates">
                <span>
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Membre depuis {{ $user->created_at->translatedFormat('F Y') }}
                </span>
                <span>
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    @if($user->last_login_at)
                        Derniere connexion {{ $user->last_login_at->diffForHumans() }}
                    @else
                        Jamais connecte
                    @endif
                </span>
            </div>
        </div>
    </div>

    {{-- Edit Form (hidden by default) --}}
    @if($isOwnProfile)
    <div class="profil-edit-form" id="editForm" style="display: none;">
        <div class="profil-edit-form__inner">
            <div class="profil-edit-form__field">
                <label for="editName">Nom</label>
                <input type="text" id="editName" class="form-input" value="{{ $user->name }}">
            </div>
            <div class="profil-edit-form__field">
                <label for="editEmail">Adresse email</label>
                <input type="email" id="editEmail" class="form-input" value="{{ $user->email }}">
            </div>
            <div class="profil-edit-form__actions">
                <button class="btn btn-sm btn-outline" onclick="toggleEditForm()">Annuler</button>
                <button class="btn btn-sm btn-primary" onclick="saveProfile()">Enregistrer</button>
            </div>
        </div>
        @if($user->pending_email)
        <div class="profil-pending-email">
            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Un changement d'email vers <strong>{{ $user->pending_email }}</strong> est en attente de verification.
        </div>
        @endif
    </div>
    @endif
</div>

{{-- ACTIVITY STATS CARDS --}}
<div class="profil-section-label">
    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
    Activite des 3 derniers mois
</div>
<div class="profil-stats-grid">
    <div class="profil-stat-card profil-stat--green">
        <div class="profil-stat__icon">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
        </div>
        <div class="profil-stat__value">{{ $stats['articles_created'] }}</div>
        <div class="profil-stat__label">Articles crees</div>
    </div>
    <div class="profil-stat-card profil-stat--blue">
        <div class="profil-stat__icon">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="M15 5l4 4"/></svg>
        </div>
        <div class="profil-stat__value">{{ $stats['articles_updated'] }}</div>
        <div class="profil-stat__label">Articles modifies</div>
    </div>
    <div class="profil-stat-card profil-stat--orange">
        <div class="profil-stat__icon">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <div class="profil-stat__value">{{ $stats['evenements'] }}</div>
        <div class="profil-stat__label">Evenements</div>
    </div>
    <div class="profil-stat-card profil-stat--bordeaux">
        <div class="profil-stat__icon">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
        </div>
        <div class="profil-stat__value">{{ $stats['dossiers'] }}</div>
        <div class="profil-stat__label">Dossiers</div>
    </div>
    <div class="profil-stat-card profil-stat--indigo">
        <div class="profil-stat__icon">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        </div>
        <div class="profil-stat__value">{{ $stats['albums'] }}</div>
        <div class="profil-stat__label">Albums galerie</div>
    </div>
    <div class="profil-stat-card profil-stat--slate">
        <div class="profil-stat__icon">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
        <div class="profil-stat__value">{{ $stats['total_actions'] }}</div>
        <div class="profil-stat__label">Actions totales</div>
    </div>
</div>

{{-- TWO COLUMN: CHART + CONTENT SUMMARY --}}
<div class="profil-two-cols">
    <div class="admin-card profil-chart-card">
        <div class="profil-card-header">
            <h2>Activite sur 3 mois</h2>
            <div class="profil-chart-legend">
                <span class="legend-item"><span class="legend-dot legend-dot--green"></span> Creations</span>
                <span class="legend-item"><span class="legend-dot legend-dot--blue"></span> Modifications</span>
                <span class="legend-item"><span class="legend-dot legend-dot--red"></span> Suppressions</span>
            </div>
        </div>
        <div class="profil-chart-wrapper">
            <canvas id="activityChart"></canvas>
        </div>
    </div>

    <div class="admin-card profil-content-card">
        <div class="profil-card-header">
            <h2>Contenus rediges</h2>
            <span class="profil-content-total">{{ $articleStats['total'] }} article(s)</span>
        </div>
        <div class="profil-content-stats">
            <div class="profil-content-stat">
                <span class="dot" style="background: var(--success);"></span>
                <span>Publies</span>
                <strong>{{ $articleStats['publie'] }}</strong>
            </div>
            <div class="profil-content-stat">
                <span class="dot" style="background: var(--warning);"></span>
                <span>Brouillons</span>
                <strong>{{ $articleStats['brouillon'] }}</strong>
            </div>
            <div class="profil-content-stat">
                <span class="dot" style="background: var(--text-400);"></span>
                <span>Archives</span>
                <strong>{{ $articleStats['archive'] }}</strong>
            </div>
        </div>
        @if($articles->count() > 0)
        <div class="profil-articles-list">
            @foreach($articles as $article)
            <div class="profil-article-item">
                <div class="profil-article-title">{{ Str::limit($article->title, 50) }}</div>
                <div class="profil-article-meta">
                    <span class="badge-status badge-{{ $article->status }}">
                        <span class="dot"></span>{{ ucfirst($article->status) }}
                    </span>
                    <span>{{ $article->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="profil-empty-content">
            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="#cbd5e1" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            <p>Aucun article redige</p>
        </div>
        @endif
    </div>
</div>

{{-- ACTIVITY TIMELINE --}}
<div class="admin-card profil-timeline-card">
    <div class="profil-card-header">
        <h2>Journal d'activite</h2>
        <span class="profil-timeline-period">Toutes les actions</span>
    </div>
    @if($timeline->count() > 0)
    <div class="profil-timeline" id="timelineContainer">
        @include('back-end.profil._timeline-items', ['timeline' => $timeline])
    </div>
    @if($timeline->hasMorePages())
    <div class="profil-timeline-more" id="loadMoreWrapper">
        <button class="btn btn-outline btn-sm" id="loadMoreBtn" onclick="loadMoreTimeline()" data-page="2" data-user="{{ $user->id }}">
            Charger plus d'activites
        </button>
    </div>
    @endif
    @else
    <div class="profil-empty-content" style="padding: 40px 20px;">
        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="#cbd5e1" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        <p>Aucune activite enregistree</p>
    </div>
    @endif
</div>

{{-- ============================================
     SUPER-ADMIN GLOBAL OVERVIEW
     ============================================ --}}
@if($isSuperAdminOwnProfile)

<div class="profil-global-divider">
    <div class="profil-global-divider__line"></div>
    <div class="profil-global-divider__label">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
        Vue d'ensemble de la plateforme
    </div>
    <div class="profil-global-divider__line"></div>
</div>

{{-- Global Stats --}}
<div class="profil-section-label">
    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
    Statistiques globales — {{ now()->translatedFormat('F Y') }}
</div>
<div class="profil-stats-grid">
    <div class="profil-stat-card profil-stat--slate">
        <div class="profil-stat__icon"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
        <div class="profil-stat__value">{{ $globalStats['total_actions_month'] }}</div>
        <div class="profil-stat__label">Actions ce mois</div>
    </div>
    <div class="profil-stat-card profil-stat--green">
        <div class="profil-stat__icon"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
        <div class="profil-stat__value">{{ $globalStats['total_created_month'] }}</div>
        <div class="profil-stat__label">Creations</div>
    </div>
    <div class="profil-stat-card profil-stat--blue">
        <div class="profil-stat__icon"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/></svg></div>
        <div class="profil-stat__value">{{ $globalStats['total_updated_month'] }}</div>
        <div class="profil-stat__label">Modifications</div>
    </div>
    <div class="profil-stat-card profil-stat--bordeaux">
        <div class="profil-stat__icon"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></div>
        <div class="profil-stat__value">{{ $globalStats['total_deleted_month'] }}</div>
        <div class="profil-stat__label">Suppressions</div>
    </div>
    <div class="profil-stat-card profil-stat--indigo">
        <div class="profil-stat__icon"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
        <div class="profil-stat__value">{{ $globalStats['active_users_month'] }}</div>
        <div class="profil-stat__label">Utilisateurs actifs</div>
    </div>
    <div class="profil-stat-card profil-stat--orange">
        <div class="profil-stat__icon"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div>
        <div class="profil-stat__value">{{ $globalStats['most_active_model'] ? class_basename($globalStats['most_active_model']->model_type) : '—' }}</div>
        <div class="profil-stat__label">Type le plus actif</div>
    </div>
</div>

{{-- Leaderboard --}}
<div class="admin-card profil-leaderboard-card">
    <div class="profil-card-header">
        <h2>
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: -2px; margin-right: 6px;"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5C7 4 7 7 7 7"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5C17 4 17 7 17 7"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>
            Classement des contributeurs — {{ now()->translatedFormat('F Y') }}
        </h2>
    </div>
    <div class="admin-table-wrapper">
        <table class="admin-table profil-leaderboard-table">
            <thead>
                <tr>
                    <th style="width: 40px;">#</th>
                    <th>Utilisateur</th>
                    <th>Role</th>
                    <th style="text-align: center;">Articles</th>
                    <th style="text-align: center;">Actions</th>
                    <th>Derniere activite</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaderboard as $index => $member)
                <tr class="{{ $member->id === auth()->id() ? 'profil-leaderboard-self' : '' }}">
                    <td>
                        <span class="profil-leaderboard-rank {{ $index < 3 ? 'profil-leaderboard-rank--top' . ($index + 1) : '' }}">{{ $index + 1 }}</span>
                    </td>
                    <td>
                        <div class="usr-user-cell">
                            @php $mbg = match($member->role) { 'super-admin' => '#1e293b', 'editeur' => '#1D8C4F', default => '#3b82f6' }; @endphp
                            <div class="usr-avatar" style="background: {{ $member->avatar ? 'transparent' : $mbg }}; width: 32px; height: 32px; font-size: 11px;">
                                @if($member->avatar)
                                    <img src="{{ asset('storage/' . $member->avatar) }}" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                                @else
                                    {{ $member->initials }}
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('admin.profil.show', $member) }}" class="usr-user-name" style="font-size: 12px;">{{ $member->name }}</a>
                                <div class="usr-user-email">{{ $member->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @php $rc = match($member->role) { 'super-admin' => 'superadmin', 'editeur' => 'editeur', default => 'redacteur' }; @endphp
                        <span class="profil-leaderboard-badge profil-leaderboard-badge--{{ $rc }}">{{ $member->getRoleLabel() }}</span>
                    </td>
                    <td style="text-align: center; font-weight: 600;">{{ $member->articles_created }}</td>
                    <td style="text-align: center;">
                        <span class="profil-leaderboard-actions">{{ $member->total_actions }}</span>
                    </td>
                    <td>
                        @if($member->last_action_at)
                            <span class="profil-leaderboard-time">{{ \Carbon\Carbon::parse($member->last_action_at)->diffForHumans() }}</span>
                        @else
                            <span style="color: var(--text-400);">—</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Global Activity Timeline --}}
<div class="admin-card profil-timeline-card">
    <div class="profil-card-header">
        <h2>Activite globale de la plateforme</h2>
        <span class="profil-timeline-period">Tous les utilisateurs</span>
    </div>
    @if($globalTimeline->count() > 0)
    <div class="profil-timeline" id="globalTimelineContainer">
        @include('back-end.profil._global-timeline-items', ['globalTimeline' => $globalTimeline])
    </div>
    @if($globalTimeline->hasMorePages())
    <div class="profil-timeline-more" id="globalLoadMoreWrapper">
        <button class="btn btn-outline btn-sm" id="globalLoadMoreBtn" onclick="loadMoreGlobalTimeline()" data-page="2" data-user="{{ $user->id }}">
            Charger plus d'activites
        </button>
    </div>
    @endif
    @else
    <div class="profil-empty-content" style="padding: 40px 20px;">
        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="#cbd5e1" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        <p>Aucune activite enregistree sur la plateforme</p>
    </div>
    @endif
</div>

@endif

@endsection

@section('scripts')
<script>
// --- Chart.js Activity Chart ---
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('activityChart');
    if (!ctx) return;
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [
                {
                    label: 'Creations',
                    data: @json($created),
                    backgroundColor: 'rgba(29, 140, 79, 0.75)',
                    borderColor: 'rgba(29, 140, 79, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                },
                {
                    label: 'Modifications',
                    data: @json($updated),
                    backgroundColor: 'rgba(59, 130, 246, 0.75)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                },
                {
                    label: 'Suppressions',
                    data: @json($deleted),
                    backgroundColor: 'rgba(239, 68, 68, 0.75)',
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { intersect: false, mode: 'index' },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleFont: { size: 12, weight: '600', family: 'Inter' },
                    bodyFont: { size: 11, family: 'Inter' },
                    padding: { top: 10, bottom: 10, left: 14, right: 14 },
                    cornerRadius: 8,
                    displayColors: true,
                    boxWidth: 8,
                    boxHeight: 8,
                    boxPadding: 4,
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 10, family: 'Inter' }, color: '#94a3b8', maxRotation: 0 },
                    stacked: true,
                    border: { display: false },
                },
                y: {
                    grid: { color: '#f1f5f9', drawBorder: false },
                    ticks: { font: { size: 10, family: 'Inter' }, color: '#94a3b8', stepSize: 1 },
                    stacked: true,
                    beginAtZero: true,
                    border: { display: false },
                }
            }
        }
    });
});

// --- Avatar Upload ---
function uploadAvatar(input) {
    if (!input.files || !input.files[0]) return;
    const file = input.files[0];
    if (file.size > 2 * 1024 * 1024) {
        showToast('warning', 'L\'image ne doit pas depasser 2 Mo.');
        return;
    }
    const formData = new FormData();
    formData.append('avatar', file);
    fetch('/admin/utilisateurs/{{ $user->id }}/avatar', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById('profileAvatar').innerHTML = '<img src="' + data.avatar_url + '" alt="" id="avatarImg">';
            showToast('success', data.message);
        } else {
            showToast('error', data.message || 'Erreur lors de l\'upload.');
        }
    })
    .catch(() => showToast('error', 'Erreur lors de l\'upload.'));
}

// --- Edit Profile ---
function toggleEditForm() {
    const form = document.getElementById('editForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function saveProfile() {
    const name = document.getElementById('editName').value.trim();
    const email = document.getElementById('editEmail').value.trim();
    if (!name || !email) {
        showToast('warning', 'Veuillez remplir tous les champs.');
        return;
    }
    fetch('/admin/profil/{{ $user->id }}/update-profile', {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name: name, email: email })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            showToast('success', data.message);
            if (data.nameChanged) {
                document.getElementById('heroName').textContent = data.newName;
            }
            toggleEditForm();
        } else {
            showToast('error', data.message || 'Erreur lors de la mise a jour.');
        }
    })
    .catch(() => showToast('error', 'Erreur lors de la mise a jour.'));
}

// --- Load More Timeline ---
function loadMoreTimeline() {
    const btn = document.getElementById('loadMoreBtn');
    const page = btn.dataset.page;
    const userId = btn.dataset.user;
    btn.disabled = true;
    btn.textContent = 'Chargement...';
    fetch('/admin/profil/' + userId + '/timeline?page=' + page, {
        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('timelineContainer').insertAdjacentHTML('beforeend', data.html);
        if (data.hasMore) {
            btn.dataset.page = data.nextPage;
            btn.disabled = false;
            btn.textContent = 'Charger plus d\'activites';
        } else {
            document.getElementById('loadMoreWrapper').remove();
        }
    })
    .catch(() => {
        btn.disabled = false;
        btn.textContent = 'Charger plus d\'activites';
        showToast('error', 'Erreur de chargement.');
    });
}

// --- Load More Global Timeline ---
function loadMoreGlobalTimeline() {
    const btn = document.getElementById('globalLoadMoreBtn');
    const page = btn.dataset.page;
    const userId = btn.dataset.user;
    btn.disabled = true;
    btn.textContent = 'Chargement...';
    fetch('/admin/profil/' + userId + '/global-timeline?page=' + page, {
        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('globalTimelineContainer').insertAdjacentHTML('beforeend', data.html);
        if (data.hasMore) {
            btn.dataset.page = data.nextPage;
            btn.disabled = false;
            btn.textContent = 'Charger plus d\'activites';
        } else {
            document.getElementById('globalLoadMoreWrapper').remove();
        }
    })
    .catch(() => {
        btn.disabled = false;
        btn.textContent = 'Charger plus d\'activites';
        showToast('error', 'Erreur de chargement.');
    });
}
</script>
@endsection
