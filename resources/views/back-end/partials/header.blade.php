<header class="admin-header">
    <div class="header-left">
        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <svg viewBox="0 0 24 24"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
        <nav class="header-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Admin</a>
            <span class="separator">/</span>
            <span class="current">@yield('breadcrumb', 'Tableau de bord')</span>
        </nav>
    </div>

    <div class="header-right">
        <a href="{{ route('home') }}" target="_blank" class="header-btn" title="Voir le site">
            <svg viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        </a>

        <form method="POST" action="{{ route('admin.logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="header-logout" title="Déconnexion">
                <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Déconnexion
            </button>
        </form>
    </div>
</header>
