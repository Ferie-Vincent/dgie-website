@extends('back-end.layouts.admin')

@section('title', $article->title)
@section('breadcrumb', 'Articles / ' . Str::limit($article->title, 30))

@section('content')
<div class="art-show">
    {{-- Top bar --}}
    <div class="art-show__topbar">
        <div class="art-show__topbar-left">
            @php
                $statusMap = ['publié' => 'publie', 'brouillon' => 'brouillon', 'archivé' => 'archive'];
            @endphp
            <span class="badge-status badge-{{ $statusMap[$article->status] ?? 'brouillon' }}">
                <span class="dot"></span>{{ ucfirst($article->status) }}
            </span>
            <span class="art-show__preview-label">Apercu en direct &bull; Vue publique</span>
        </div>
        <div class="art-show__topbar-right">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-outline btn-sm">
                <svg viewBox="0 0 24 24" width="16" height="16"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Retour
            </a>
            <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-primary btn-sm">Modifier</a>
        </div>
    </div>

    {{-- Hero image --}}
    <div class="art-show__hero" @if($article->image) style="background-image: url('{{ asset('storage/' . $article->image) }}')" @endif>
        <div class="art-show__hero-overlay">
            @if($article->category)
            <span class="art-show__category">{{ $article->category->name }}</span>
            @endif
            <h1 class="art-show__title">{{ $article->title }}</h1>
        </div>
    </div>

    {{-- Meta info --}}
    <div class="art-show__meta">
        <div class="art-show__author">
            <div class="art-show__avatar">
                {{ strtoupper(substr($article->author->name ?? 'A', 0, 1)) }}{{ strtoupper(substr(explode(' ', $article->author->name ?? 'A')[1] ?? '', 0, 1)) }}
            </div>
            <div>
                <div class="art-show__author-name">{{ $article->author->name ?? 'Auteur inconnu' }}</div>
                <div class="art-show__author-role">{{ ucfirst($article->author->role ?? 'redacteur') }}</div>
            </div>
        </div>
        <div class="art-show__meta-sep"></div>
        <div class="art-show__meta-item">
            <svg viewBox="0 0 24 24" width="16" height="16"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            {{ $article->published_at ? $article->published_at->format('d/m/Y') : $article->created_at->format('d/m/Y') }}
        </div>
        <div class="art-show__meta-sep"></div>
        <div class="art-show__meta-item">
            <svg viewBox="0 0 24 24" width="16" height="16"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            {{ $article->read_time ?? 1 }} min de lecture
        </div>
    </div>

    {{-- Excerpt --}}
    @if($article->excerpt)
    <div class="art-show__excerpt">
        {{ $article->excerpt }}
    </div>
    @endif

    {{-- Content --}}
    <div class="art-show__content">
        {!! $article->content !!}
    </div>

    {{-- Tags --}}
    @if($article->category)
    <div class="art-show__tags">
        <span class="art-show__tags-label">Mots-cles :</span>
        <span class="art-show__tag">{{ $article->category->name }}</span>
        <span class="art-show__tag">{{ $article->section === 'diaspora' ? 'Diaspora' : 'General' }}</span>
    </div>
    @endif

    {{-- Footer stats --}}
    <div class="art-show__footer">
        <div class="art-show__stats">
            <span class="art-show__stat">
                <svg viewBox="0 0 24 24" width="16" height="16"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                {{ $article->comments_count ?? $article->comments->count() }} commentaire(s)
            </span>
        </div>
        <div class="art-show__actions">
            <button class="btn btn-outline btn-sm" onclick="window.print()">Imprimer</button>
            <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-primary btn-sm">Modifier l'article</a>
        </div>
    </div>
</div>
@endsection
