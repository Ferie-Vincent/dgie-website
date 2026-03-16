<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'DGIE — Direction Générale des Ivoiriens de l\'Extérieur')</title>
  @yield('meta')
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32.png') }}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/icons/icon-192.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-touch-icon.png') }}">
  <link rel="manifest" href="{{ asset('manifest.json') }}">
  <meta name="theme-color" content="#E8772A">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="dns-prefetch" href="https://img.youtube.com">
  <link rel="dns-prefetch" href="https://images.unsplash.com">
  <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700&display=swap">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css?v=32') }}">
  @yield('preload')
  @yield('head')

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-H3SHBWK6HQ"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-H3SHBWK6HQ');
  </script>

</head>
<body>
<a href="#main-content" class="skip-link">Aller au contenu principal</a>

  @include('front-end.partials.preloader')
  @yield('modals')
  @include('front-end.partials.banner-pub')
  @include('front-end.partials.top-bar')
  @include('front-end.partials.flash-infos')
  @include('front-end.partials.header')

  @yield('content')

  @include('front-end.partials.newsletter')
  @include('front-end.partials.footer')
  @include('front-end.partials.back-to-top')
  @include('front-end.partials.cookie-consent')

  <script src="{{ asset('assets/js/main.js?v=12') }}" defer></script>
  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', function() {
        navigator.serviceWorker.register('/service-worker.js')
          .then(function(reg) { console.log('SW enregistré:', reg.scope); })
          .catch(function(err) { console.log('SW erreur:', err); });
      });
    }
  </script>
  @stack('scripts')
</body>
</html>
