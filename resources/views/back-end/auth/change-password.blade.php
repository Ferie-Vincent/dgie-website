<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer votre mot de passe — DGIE Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css?v=2') }}">
</head>
<body class="admin-body">
    <div class="login-page">
        {{-- Left: Form --}}
        <div class="login-left">
            <div class="login-form-wrapper">
                <div class="login-logo">
                    <img src="{{ asset('assets/images/logo-dgie.png') }}" alt="DGIE">
                    <div class="login-logo-text">
                        DGIE
                        <span>Direction Generale des Ivoiriens de l'Exterieur</span>
                    </div>
                </div>

                <h1 class="login-title">Changer votre mot de passe</h1>
                <p class="login-subtitle" style="color: #c25e15; font-weight: 500;">Votre mot de passe doit etre change avant de pouvoir acceder au tableau de bord.</p>

                @if(session('warning'))
                <div class="login-error" style="background: #fff3cd; border-color: #ffc107; color: #856404;">
                    {{ session('warning') }}
                </div>
                @endif

                @if($errors->any())
                <div class="login-error">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
                @endif

                <form method="POST" action="{{ route('admin.password.update') }}" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="password">Nouveau mot de passe</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" class="form-input" placeholder="Minimum 8 caracteres" required autofocus>
                            <button type="button" class="toggle-password" onclick="togglePassword('password', 'eyeIcon1')">
                                <svg id="eyeIcon1" viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" fill="none" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmer le mot de passe</label>
                        <div class="input-wrapper">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Confirmez votre mot de passe" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                                <svg id="eyeIcon2" viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" fill="none" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="login-btn">Enregistrer le nouveau mot de passe</button>
                </form>

                <div style="text-align: center; margin-top: 1rem;">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #64748b; cursor: pointer; font-size: 0.875rem; text-decoration: underline;">Se deconnecter</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Right: Decorative panel --}}
        <div class="login-right">
            <div class="login-decoration login-decoration-1"></div>
            <div class="login-decoration login-decoration-2"></div>
            <div class="login-decoration login-decoration-3"></div>

            <div class="login-right-content">
                <div class="icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </div>
                <h2>Changement de mot de passe</h2>
                <p>Pour la securite de votre compte, veuillez definir un nouveau mot de passe personnalise avant d'acceder au tableau de bord.</p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
            }
        }
    </script>
</body>
</html>
