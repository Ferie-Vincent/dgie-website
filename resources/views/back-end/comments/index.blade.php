@extends('back-end.layouts.admin')

@section('title', 'Commentaires')
@section('breadcrumb', 'Commentaires')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Commentaires</h1>
        <p class="content-subtitle">{{ $pendingCount }} commentaire(s) en attente</p>
    </div>
</div>

{{-- Toolbar --}}
<div class="toolbar">
    <div class="toolbar-search">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <form method="GET">
            <input type="text" name="search" placeholder="Rechercher un commentaire..." value="{{ request('search') }}">
        </form>
    </div>
    <div class="toolbar-filter">
        <form method="GET" style="display:flex; gap:8px;">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <select name="status" onchange="this.form.submit()">
                <option value="">Tous les statuts</option>
                <option value="approuve" {{ request('status') == 'approuve' ? 'selected' : '' }}>Approuvé</option>
                <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>En attente</option>
            </select>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($comments->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Auteur</th>
                    <th>Article</th>
                    <th>Contenu</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                <tr>
                    <td>
                        <div class="table-title">{{ $comment->name }}</div>
                        <div class="table-excerpt">{{ $comment->email }}</div>
                    </td>
                    <td>
                        <span style="font-size: 12px;">
                            @if($comment->article)
                                <a href="{{ route('admin.articles.edit', $comment->article) }}" style="color: var(--admin-primary);">{{ Str::limit($comment->article->title, 40) }}</a>
                            @else
                                <span style="color: var(--admin-text-light);">—</span>
                            @endif
                        </span>
                    </td>
                    <td>
                        <span style="font-size: 12px;">{{ Str::limit($comment->content, 60) }}</span>
                    </td>
                    <td>
                        @if($comment->is_approved)
                            <span class="badge-status badge-publie">
                                <span class="dot"></span>
                                Approuvé
                            </span>
                        @else
                            <span class="badge-status badge-brouillon">
                                <span class="dot"></span>
                                En attente
                            </span>
                        @endif
                    </td>
                    <td style="font-size: 12px; color: var(--admin-text-light); white-space: nowrap;">
                        {{ $comment->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td>
                        <div class="table-actions">
                            @if(!$comment->is_approved)
                                <form action="{{ route('admin.comments.approve', $comment) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="action-btn edit" title="Approuver" aria-label="Approuver" style="color: var(--admin-success, #16a34a);">
                                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.comments.reject', $comment) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="action-btn edit" title="Rejeter" aria-label="Rejeter" style="color: var(--admin-warning, #ea580c);">
                                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                                    </button>
                                </form>
                            @endif
                            <form id="delete-comment-{{ $comment->id }}" action="{{ route('admin.comments.destroy', $comment) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-comment-{{ $comment->id }}" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($comments->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $comments->firstItem() }} à {{ $comments->lastItem() }} sur {{ $comments->total() }}
        </div>
        <div class="pagination-links">
            {{ $comments->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <h3>Aucun commentaire</h3>
        <p>Les commentaires des visiteurs apparaîtront ici.</p>
    </div>
    @endif
</div>
@endsection
