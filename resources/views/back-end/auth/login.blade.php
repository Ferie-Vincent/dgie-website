<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — DGIE Admin</title>
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
                        <span>Direction Générale des Ivoiriens de l'Extérieur</span>
                    </div>
                </div>

                <h1 class="login-title">Connexion</h1>
                <p class="login-subtitle">Accédez à votre espace d'administration</p>

                @if($errors->any())
                <div class="login-error">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="email">Adresse e-mail</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="admin@dgie.gouv.ci" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" class="form-input" placeholder="Votre mot de passe" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <svg id="eyeIcon" viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" fill="none" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember"> Se souvenir de moi
                        </label>
                    </div>

                    <button type="submit" class="login-btn">Se connecter</button>
                </form>
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
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h2>Espace Administration</h2>
                <p>Gérez le contenu du site de la Direction Générale des Ivoiriens de l'Extérieur depuis votre tableau de bord sécurisé.</p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
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
