@extends('back-end.layouts.admin')

@section('title', 'Newsletter')
@section('breadcrumb', 'Newsletter')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Newsletter</h1>
        <p class="content-subtitle">{{ $activeCount }} abonné(s) actif(s) sur {{ $totalCount }} total</p>
    </div>
</div>

{{-- Toolbar --}}
<div class="toolbar">
    <div class="toolbar-search">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <form method="GET">
            <input type="text" name="search" placeholder="Rechercher un abonné..." value="{{ request('search') }}">
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($subscribers->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Date d'inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscribers as $subscriber)
                <tr>
                    <td>
                        <div class="table-title">{{ $subscriber->email }}</div>
                    </td>
                    <td>
                        @if($subscriber->is_active)
                            <span class="badge-status badge-publie">
                                <span class="dot"></span>
                                Actif
                            </span>
                        @else
                            <span class="badge-status badge-brouillon">
                                <span class="dot"></span>
                                Inactif
                            </span>
                        @endif
                    </td>
                    <td style="font-size: 12px; color: var(--admin-text-light); white-space: nowrap;">
                        {{ $subscriber->subscribed_at ? $subscriber->subscribed_at->format('d/m/Y H:i') : $subscriber->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td>
                        <div class="table-actions">
                            <form id="delete-subscriber-{{ $subscriber->id }}" action="{{ route('admin.newsletter.destroy', $subscriber) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-subscriber-{{ $subscriber->id }}" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($subscribers->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $subscribers->firstItem() }} à {{ $subscribers->lastItem() }} sur {{ $subscribers->total() }}
        </div>
        <div class="pagination-links">
            {{ $subscribers->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        <h3>Aucun abonné</h3>
        <p>Les abonnés à la newsletter apparaîtront ici.</p>
    </div>
    @endif
</div>
@endsection
