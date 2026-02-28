<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration') — DGIE Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css?v=3') }}">
    @yield('head')
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        {{-- Sidebar --}}
        @include('back-end.partials.sidebar')

        {{-- Overlay mobile --}}
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        {{-- Main content --}}
        <div class="admin-main">
            @include('back-end.partials.header')

            <div class="admin-content">
                @include('back-end.partials.alerts')
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // ========== Mobile sidebar ==========
        const menuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('adminSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (menuBtn) {
            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                sidebarOverlay.classList.toggle('active');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                sidebarOverlay.classList.remove('active');
            });
        }

        // ========== Toast notifications ==========
        function dismissToast(toast) {
            toast.classList.add('toast--dismiss');
            setTimeout(() => toast.remove(), 400);
        }

        document.querySelectorAll('.toast[data-auto-dismiss]').forEach(toast => {
            setTimeout(() => dismissToast(toast), 5000);
        });

        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.toast__close');
            if (btn) dismissToast(btn.closest('.toast'));
        });

        // Global helper to show toasts from JS
        window.showToast = function(type, message, title) {
            const icons = {
                success: '<svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
                error: '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
                warning: '<svg viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
                info: '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>'
            };
            const titles = { success: 'Succès', error: 'Erreur', warning: 'Attention', info: 'Information' };
            const container = document.getElementById('toastContainer');
            if (!container) return;
            const toast = document.createElement('div');
            toast.className = 'toast toast--' + type;
            toast.setAttribute('data-auto-dismiss', '');
            toast.innerHTML = '<div class="toast__icon">' + (icons[type] || icons.info) + '</div>'
                + '<div class="toast__content"><div class="toast__title">' + (title || titles[type] || '') + '</div>'
                + '<div class="toast__message">' + message + '</div></div>'
                + '<button class="toast__close" aria-label="Fermer"><svg viewBox="0 0 24 24" width="16" height="16"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
                + '<div class="toast__progress"></div>';
            container.appendChild(toast);
            setTimeout(() => dismissToast(toast), 5000);
        };

        // ========== Modal System ==========
        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.classList.add('active');
        }

        // View modal helpers
        function showViewModal(title, subtitle, html, raw) {
            var header = document.querySelector('#viewModal .admin-modal-header');
            var footer = document.querySelector('#viewModal .admin-modal-footer');
            var body = document.querySelector('#viewModal .admin-modal-body');
            var modal = document.querySelector('#viewModal .admin-modal');
            if (raw) {
                if (header) header.style.display = 'none';
                if (footer) footer.style.display = 'none';
                if (body) body.style.padding = '0';
                if (modal) modal.style.maxWidth = '900px';
            } else {
                if (header) header.style.display = '';
                if (footer) footer.style.display = '';
                if (body) body.style.padding = '';
                if (modal) modal.style.maxWidth = '';
                document.getElementById('viewModalTitle').textContent = title;
                var sub = document.getElementById('viewModalSubtitle');
                if (sub) { sub.textContent = subtitle || ''; sub.style.display = subtitle ? '' : 'none'; }
            }
            document.getElementById('viewModalBody').innerHTML = html;
            openModal('viewModal');
        }

        function vRow(label, value) {
            if (value === null || value === undefined || value === '') return '';
            return '<div class="view-detail-row"><span class="view-detail-label">' + label + '</span><span class="view-detail-value">' + value + '</span></div>';
        }

        function vBadge(status) {
            return '<span class="badge-status badge-' + status + '"><span class="dot"></span>' + status.charAt(0).toUpperCase() + status.slice(1) + '</span>';
        }

        function vImage(url) {
            if (!url) return '<span style="color:var(--text-400)">—</span>';
            return '<img src="' + url + '" alt="">';
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.classList.remove('active');
        }

        function closeAllModals() {
            document.querySelectorAll('.admin-modal-overlay.active').forEach(m => m.classList.remove('active'));
        }

        // Close modal buttons
        document.addEventListener('click', function(e) {
            if (e.target.matches('[data-close-modal]') || e.target.closest('[data-close-modal]')) {
                const overlay = e.target.closest('.admin-modal-overlay');
                if (overlay) overlay.classList.remove('active');
            }
        });

        // Click outside modal to close
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('admin-modal-overlay') && e.target.classList.contains('active')) {
                e.target.classList.remove('active');
            }
        });

        // Escape key to close
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeAllModals();
        });

        // ========== Delete Modal ==========
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('[data-delete-form]');
            if (!btn) return;
            e.preventDefault();
            const formId = btn.getAttribute('data-delete-form');
            const itemName = btn.getAttribute('data-delete-name') || 'cet élément';
            const modal = document.getElementById('deleteModal');
            const confirmBtn = document.getElementById('deleteConfirmBtn');
            const nameEl = document.getElementById('deleteItemName');

            if (nameEl) nameEl.textContent = itemName;
            if (modal && confirmBtn) {
                modal.classList.add('active');
                confirmBtn.onclick = () => document.getElementById(formId).submit();
            }
        });

        // ========== Create Modal ==========
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('[data-open-create]');
            if (btn) {
                e.preventDefault();
                openModal('createModal');
            }
        });

        // ========== Edit Modal ==========
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('[data-edit-btn]');
            if (!btn) return;
            e.preventDefault();

            const editModal = document.getElementById('editModal');
            if (!editModal) return;

            const editForm = editModal.querySelector('form');
            const baseUrl = editModal.dataset.routeBase;
            const id = btn.dataset.id;

            // Set form action
            if (editForm && baseUrl && id) {
                editForm.action = baseUrl + '/' + id;
            }

            // Populate form fields from data attributes
            const dataset = btn.dataset;
            for (const key in dataset) {
                if (key === 'id' || key === 'editBtn') continue;
                const field = editModal.querySelector('[name="' + key + '"]');
                if (!field) continue;

                if (field.type === 'checkbox') {
                    field.checked = dataset[key] === '1' || dataset[key] === 'true';
                } else if (field.tagName === 'SELECT') {
                    field.value = dataset[key];
                } else {
                    field.value = dataset[key];
                }
            }

            // Update image preview if exists
            const previewImg = editModal.querySelector('.modal-image-preview img');
            if (previewImg && dataset.imageUrl) {
                previewImg.src = dataset.imageUrl;
                previewImg.closest('.modal-image-preview').style.display = dataset.imageUrl ? 'block' : 'none';
            }

            openModal('editModal');
        });

        // ========== Image preview helper for fullpage modals ==========
        function previewImage(input, placeholderId) {
            var placeholder = document.getElementById(placeholderId);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    placeholder.innerHTML = '<div class="fp-image-preview"><img src="' + e.target.result + '" alt=""></div>';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // ========== Auto-reopen modal on validation errors ==========
        document.addEventListener('DOMContentLoaded', function() {
            const modalType = document.querySelector('meta[name="reopen-modal"]');
            if (modalType) {
                const type = modalType.getAttribute('content');
                if (type === 'create') {
                    openModal('createModal');
                } else if (type === 'edit') {
                    const editId = document.querySelector('meta[name="edit-id"]');
                    if (editId) {
                        const editModal = document.getElementById('editModal');
                        if (editModal) {
                            const editForm = editModal.querySelector('form');
                            const baseUrl = editModal.dataset.routeBase;
                            if (editForm && baseUrl) {
                                editForm.action = baseUrl + '/' + editId.getAttribute('content');
                            }
                        }
                    }
                    openModal('editModal');
                }
            }
        });
    </script>

    {{-- View detail modal --}}
    <div class="admin-modal-overlay" id="viewModal">
        <div class="admin-modal modal-xl">
            <div class="admin-modal-header">
                <div>
                    <h3 id="viewModalTitle">Détails</h3>
                    <p id="viewModalSubtitle"></p>
                </div>
                <button type="button" class="admin-modal-close" data-close-modal>
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="admin-modal-body">
                <div id="viewModalBody"></div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="btn btn-outline" data-close-modal>Fermer</button>
            </div>
        </div>
    </div>

    {{-- Delete confirmation modal --}}
    <div class="admin-modal-overlay" id="deleteModal">
        <div class="admin-modal">
            <div class="admin-modal-body modal-delete-body">
                <div class="modal-warning-icon">
                    <svg viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                </div>
                <h4>Supprimer <span id="deleteItemName">cet élément</span> ?</h4>
                <p>Cette action est irréversible. L'élément sera définitivement retiré de la base de données.</p>
            </div>
            <div class="admin-modal-footer">
                <button class="btn btn-outline" data-close-modal>Annuler</button>
                <button class="btn btn-danger" id="deleteConfirmBtn">Supprimer</button>
            </div>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
