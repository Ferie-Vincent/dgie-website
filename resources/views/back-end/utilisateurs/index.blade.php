@extends('back-end.layouts.admin')

@section('title', 'Utilisateurs')
@section('breadcrumb', 'Utilisateurs')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Gestion des Utilisateurs</h1>
        <p class="content-subtitle">Gérez les utilisateurs et leurs rôles d'accès à la plateforme.</p>
    </div>
    <button class="btn btn-primary" onclick="openInviteModal()">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
        Inviter un utilisateur
    </button>
</div>

{{-- Vue d'ensemble des rôles --}}
<div class="usr-section-title">
    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12l2 2l4-4"/></svg>
    Vue d'ensemble des rôles
</div>
<div class="usr-roles-grid">
    <div class="usr-role-card usr-role-superadmin">
        <div class="usr-role-icon-bg">
            <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294zM5 21h14"/></svg>
        </div>
        <span class="usr-role-badge superadmin">Super Administrateur</span>
        <span class="usr-role-count">{{ $roleCounts['super-admin'] }} utilisateur(s)</span>
        <p class="usr-role-desc">Accès souverain. Gestion totale de la configuration.</p>
    </div>
    <div class="usr-role-card usr-role-editeur">
        <span class="usr-role-badge editeur">Éditeur</span>
        <span class="usr-role-count">{{ $roleCounts['editeur'] }} utilisateur(s)</span>
        <p class="usr-role-desc">Responsable opérationnel. Gestion complète des contenus.</p>
    </div>
    <div class="usr-role-card usr-role-redacteur">
        <span class="usr-role-badge redacteur">Rédacteur</span>
        <span class="usr-role-count">{{ $roleCounts['redacteur'] }} utilisateur(s)</span>
        <p class="usr-role-desc">Créateur de contenu. Accès strict aux modules éditoriaux.</p>
    </div>
</div>

{{-- Annuaire Utilisateurs --}}
<div class="usr-section-title" style="margin-top: 32px;">
    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M16 3.128a4 4 0 0 1 0 7.744M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg>
    Annuaire Utilisateurs
</div>

<div class="usr-toolbar">
    <div class="usr-search">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" placeholder="Rechercher un utilisateur..." onkeyup="liveSearch(this)">
    </div>
</div>

<div class="admin-card" style="padding: 0;">
    @if($users->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table usr-table">
            <thead>
                <tr>
                    <th style="width: 40px;"><input type="checkbox" class="usr-checkbox" onchange="toggleSelectAll(this)"></th>
                    <th>Utilisateur</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Dernière Connexion</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody id="users-table-body">
                @foreach($users as $user)
                <tr data-user-id="{{ $user->id }}">
                    <td><input type="checkbox" class="usr-checkbox"></td>
                    <td>
                        <div class="usr-user-cell">
                            <div class="usr-avatar" style="background: {{ $user->role === 'super-admin' ? 'var(--admin-sidebar-bg, #1e293b)' : ($user->role === 'editeur' ? 'var(--admin-green, #1D8C4F)' : 'var(--admin-info, #3b82f6)') }};">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="usr-user-name">{{ $user->name }}</div>
                                <div class="usr-user-email">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @php
                            $roleClass = match($user->role) {
                                'super-admin' => 'superadmin',
                                'editeur' => 'editeur',
                                'redacteur' => 'redacteur',
                                default => 'redacteur',
                            };
                        @endphp
                        <span class="usr-role-badge {{ $roleClass }}">{{ $user->getRoleLabel() }}</span>
                    </td>
                    <td>
                        <span class="usr-status-badge active">
                            <span class="usr-status-dot"></span> Actif
                        </span>
                    </td>
                    <td class="usr-last-login">
                        @if($user->last_login_at)
                            {{ $user->last_login_at->diffForHumans() }}
                        @else
                            Jamais connecté
                        @endif
                    </td>
                    <td>
                        <div class="usr-actions">
                            <button class="usr-action-btn edit" title="Modifier" aria-label="Modifier"
                                onclick="editUser({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->email }}', '{{ $user->role }}')">
                                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497zM15 5l4 4"/></svg>
                            </button>
                            @if($user->id !== auth()->id())
                            <button class="usr-action-btn" title="Réinitialiser le mot de passe" aria-label="Réinitialiser le mot de passe" style="color: var(--admin-warning, #f59e0b);"
                                onclick="resetPassword({{ $user->id }}, '{{ addslashes($user->name) }}')">
                                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 9.9-1"/></svg>
                            </button>
                            <button class="usr-action-btn delete" title="Supprimer" aria-label="Supprimer"
                                onclick="confirmDeleteUser({{ $user->id }}, '{{ addslashes($user->name) }}')">
                                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="usr-pagination">
        <p class="usr-pagination-info">
            Affichage de <strong>{{ $users->firstItem() ?? 0 }}</strong> à <strong>{{ $users->lastItem() ?? 0 }}</strong> sur <strong>{{ $users->total() }}</strong> utilisateurs
        </p>
        <div>{{ $users->links() }}</div>
    </div>
    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        <h3>Aucun utilisateur</h3>
        <p>Invitez un utilisateur pour commencer.</p>
        <button class="btn btn-primary btn-sm" onclick="openInviteModal()">Inviter un utilisateur</button>
    </div>
    @endif
</div>

{{-- Modal Inviter / Modifier --}}
<div class="admin-modal-overlay" id="inviteModal">
    <div class="admin-modal" style="max-width: 480px;">
        <div class="modal-fp-header" style="padding: 16px 20px;">
            <div>
                <h3 id="modal-invite-title">Inviter un utilisateur</h3>
            </div>
            <button type="button" class="modal-fp-close" onclick="closeInviteModal()">
                <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div style="padding: 20px;">
            <div class="usr-info-notice" id="invite-notice">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                <span>Un email d'invitation sera envoyé avec les identifiants de connexion. L'utilisateur devra modifier son mot de passe à la première connexion.</span>
            </div>
            <div class="form-group" style="margin-top: 16px;">
                <label class="usr-label">Nom complet *</label>
                <input type="text" id="input-name" class="form-input" placeholder="Ex : Jean Dupont">
            </div>
            <div class="form-group">
                <label class="usr-label">Adresse email *</label>
                <input type="email" id="input-email" class="form-input" placeholder="nom.prenom@dgie.gouv.ci">
            </div>
            <div class="form-group">
                <label class="usr-label">Rôle *</label>
                <select id="input-role" class="form-select">
                    <option value="">Sélectionnez un rôle</option>
                    @foreach($roles as $role)
                    <option value="{{ $role['value'] }}">{{ $role['label'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="usr-modal-footer">
            <button type="button" class="btn btn-outline" onclick="closeInviteModal()">Annuler</button>
            <button type="button" id="invite-btn" class="btn btn-primary" onclick="inviteUser()">Envoyer l'invitation</button>
        </div>
    </div>
</div>

{{-- Modal Mot de passe généré --}}
<div class="admin-modal-overlay" id="passwordModal">
    <div class="admin-modal" style="max-width: 480px;">
        <div class="modal-fp-header" style="padding: 16px 20px;">
            <div>
                <h3 id="password-modal-title">Mot de passe généré</h3>
            </div>
            <button type="button" class="modal-fp-close" onclick="closePasswordModal()">
                <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div style="padding: 20px;">
            <p id="password-modal-message" style="font-size: 13px; color: var(--admin-text-light); margin-bottom: 16px;"></p>
            <div style="background: var(--admin-bg); border: 1px solid var(--admin-border); border-radius: 8px; padding: 16px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                <div>
                    <span style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--admin-text-light); font-weight: 600;">Mot de passe temporaire</span>
                    <div id="password-modal-value" style="font-family: monospace; font-size: 18px; font-weight: 700; color: var(--admin-text); letter-spacing: 1px; margin-top: 4px;"></div>
                </div>
                <button type="button" class="btn btn-outline btn-sm" onclick="copyPassword()" id="copy-pwd-btn" style="white-space: nowrap;">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -2px;"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                    Copier
                </button>
            </div>
            <div class="usr-info-notice" style="margin-top: 16px; background: #fef3c7; border-color: #f59e0b;">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#92400e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18l-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3M12 9v4m0 4h.01"/></svg>
                <span style="color: #92400e;" id="password-modal-mail-status"></span>
            </div>
        </div>
        <div class="usr-modal-footer">
            <button type="button" class="btn btn-primary" onclick="closePasswordModal()">Compris</button>
        </div>
    </div>
</div>

{{-- Modal Confirmer Réinitialisation --}}
<div class="admin-modal-overlay" id="resetModal">
    <div class="admin-modal" style="max-width: 400px;">
        <div style="padding: 32px; text-align: center;">
            <div style="width: 48px; height: 48px; border-radius: 50%; background: #fef3c7; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 9.9-1"/></svg>
            </div>
            <h3 style="font-size: 15px; font-weight: 600; color: var(--admin-text); margin-bottom: 8px;">Réinitialiser le mot de passe</h3>
            <p style="font-size: 13px; color: var(--admin-text-light); margin-bottom: 24px;">
                Un nouveau mot de passe sera généré pour <strong id="reset-user-name"></strong> et envoyé par email. L'utilisateur devra le changer à sa prochaine connexion.
            </p>
            <div style="display: flex; justify-content: center; gap: 12px;">
                <button type="button" class="btn btn-outline" onclick="closeResetModal()">Annuler</button>
                <button type="button" class="btn" style="background: #f59e0b; color: #fff; border-color: #d97706;" id="confirm-reset-btn" onclick="confirmReset()">Réinitialiser</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Confirmer Suppression --}}
<div class="admin-modal-overlay" id="deleteModal">
    <div class="admin-modal" style="max-width: 400px;">
        <div style="padding: 32px; text-align: center;">
            <div class="usr-delete-icon">
                <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18l-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3M12 9v4m0 4h.01"/></svg>
            </div>
            <h3 style="font-size: 15px; font-weight: 600; color: var(--admin-text); margin-bottom: 8px;">Confirmer la suppression</h3>
            <p style="font-size: 13px; color: var(--admin-text-light); margin-bottom: 24px;">
                Êtes-vous sûr de vouloir supprimer <strong id="delete-user-name"></strong> ? Cette action est irréversible.
            </p>
            <div style="display: flex; justify-content: center; gap: 12px;">
                <button type="button" class="btn btn-outline" onclick="closeDeleteModal()">Annuler</button>
                <button type="button" class="btn" style="background: #dc2626; color: #fff; border-color: #b91c1c;" onclick="confirmDelete()">Supprimer définitivement</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let currentEditUserId = null;
let currentDeleteUserId = null;

function openInviteModal() {
    currentEditUserId = null;
    document.getElementById('input-name').value = '';
    document.getElementById('input-email').value = '';
    document.getElementById('input-role').value = '';
    document.getElementById('modal-invite-title').textContent = 'Inviter un utilisateur';
    document.getElementById('invite-btn').textContent = "Envoyer l'invitation";
    document.getElementById('invite-notice').style.display = '';
    document.getElementById('inviteModal').classList.add('active');
}

function closeInviteModal() {
    document.getElementById('inviteModal').classList.remove('active');
}

function editUser(id, name, email, role) {
    currentEditUserId = id;
    document.getElementById('input-name').value = name;
    document.getElementById('input-email').value = email;
    document.getElementById('input-role').value = role;
    document.getElementById('modal-invite-title').textContent = "Modifier l'utilisateur";
    document.getElementById('invite-btn').textContent = 'Enregistrer';
    document.getElementById('invite-notice').style.display = 'none';
    document.getElementById('inviteModal').classList.add('active');
}

function inviteUser() {
    const name = document.getElementById('input-name').value.trim();
    const email = document.getElementById('input-email').value.trim();
    const role = document.getElementById('input-role').value;

    if (!name || !email || !role) {
        showToast('warning', 'Veuillez remplir tous les champs obligatoires.');
        return;
    }

    const btn = document.getElementById('invite-btn');
    btn.disabled = true;
    btn.textContent = 'Envoi en cours...';

    const url = currentEditUserId
        ? '/admin/utilisateurs/' + currentEditUserId
        : '/admin/utilisateurs';
    const method = currentEditUserId ? 'PUT' : 'POST';

    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ name, email, role })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            closeInviteModal();
            if (data.password) {
                showPasswordModal('Utilisateur créé avec succès', data.message, data.password, data.mail_sent);
            } else {
                showToast('success', data.message);
                setTimeout(() => location.reload(), 1500);
            }
        } else {
            showToast('error', data.message || 'Une erreur est survenue.');
            btn.disabled = false;
            btn.textContent = currentEditUserId ? 'Enregistrer' : "Envoyer l'invitation";
        }
    })
    .catch(err => {
        console.error(err);
        showToast('error', 'Une erreur est survenue.');
        btn.disabled = false;
        btn.textContent = currentEditUserId ? 'Enregistrer' : "Envoyer l'invitation";
    });
}

function confirmDeleteUser(id, name) {
    currentDeleteUserId = id;
    document.getElementById('delete-user-name').textContent = name;
    document.getElementById('deleteModal').classList.add('active');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('active');
}

function confirmDelete() {
    if (!currentDeleteUserId) return;

    fetch('/admin/utilisateurs/' + currentDeleteUserId, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            closeDeleteModal();
            showToast('success', data.message);
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast('error', data.message || 'Une erreur est survenue.');
        }
    })
    .catch(err => {
        console.error(err);
        showToast('error', 'Une erreur est survenue.');
    });
}

function liveSearch(input) {
    const term = input.value.toLowerCase();
    const rows = document.querySelectorAll('#users-table-body tr');
    rows.forEach(row => {
        if (row.querySelector('td[colspan]')) return;
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(term) ? '' : 'none';
    });
}

function toggleSelectAll(cb) {
    document.querySelectorAll('#users-table-body .usr-checkbox').forEach(c => c.checked = cb.checked);
}

// --- Password modal ---
function showPasswordModal(title, message, password, mailSent) {
    document.getElementById('password-modal-title').textContent = title;
    document.getElementById('password-modal-message').textContent = message;
    document.getElementById('password-modal-value').textContent = password;
    document.getElementById('password-modal-mail-status').textContent = mailSent
        ? 'Ce mot de passe a aussi été envoyé par email. Vous pouvez le copier pour le transmettre manuellement si besoin.'
        : 'L\'email n\'a pas pu être envoyé. Copiez ce mot de passe et transmettez-le manuellement à l\'utilisateur.';
    document.getElementById('copy-pwd-btn').textContent = 'Copier';
    document.getElementById('passwordModal').classList.add('active');
}

function closePasswordModal() {
    document.getElementById('passwordModal').classList.remove('active');
    location.reload();
}

function copyPassword() {
    const pwd = document.getElementById('password-modal-value').textContent;
    navigator.clipboard.writeText(pwd).then(() => {
        const btn = document.getElementById('copy-pwd-btn');
        btn.innerHTML = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -2px;"><path d="M20 6L9 17l-5-5"/></svg> Copié !';
        setTimeout(() => { btn.textContent = 'Copier'; }, 2000);
    });
}

// --- Reset password ---
let currentResetUserId = null;

function resetPassword(id, name) {
    currentResetUserId = id;
    document.getElementById('reset-user-name').textContent = name;
    document.getElementById('resetModal').classList.add('active');
}

function closeResetModal() {
    document.getElementById('resetModal').classList.remove('active');
}

function confirmReset() {
    if (!currentResetUserId) return;

    const btn = document.getElementById('confirm-reset-btn');
    btn.disabled = true;
    btn.textContent = 'Envoi en cours...';

    fetch('/admin/utilisateurs/' + currentResetUserId + '/reset-password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(r => r.json())
    .then(data => {
        closeResetModal();
        btn.disabled = false;
        btn.textContent = 'Réinitialiser';
        if (data.success) {
            showPasswordModal('Mot de passe réinitialisé', data.message, data.password, data.mail_sent);
        } else {
            showToast('error', data.message || 'Une erreur est survenue.');
        }
    })
    .catch(err => {
        console.error(err);
        btn.disabled = false;
        btn.textContent = 'Réinitialiser';
        showToast('error', 'Une erreur est survenue.');
    });
}
</script>
@endsection
