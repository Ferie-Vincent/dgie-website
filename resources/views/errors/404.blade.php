@extends('front-end.layouts.app')

@section('title', 'Page non trouvée — DGIE')

@section('meta')
  <meta name="description" content="La page que vous recherchez n'existe pas ou a été déplacée.">
  <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
  <!-- PAGE 404 -->
  <section class="page-404" id="main-content">
    <div class="page-404__code">404</div>
    <h1 class="page-404__title">Page non trouvée</h1>
    <p class="page-404__text">La page que vous recherchez n'existe pas, a été déplacée ou est temporairement indisponible.</p>
    <div class="page-404__actions">
      <a href="{{ route('home') }}" class="page-404__btn page-404__btn--primary">Retour à l'accueil</a>
      <a href="{{ route('contact') }}" class="page-404__btn page-404__btn--secondary">Nous contacter</a>
    </div>
  </section>
@endsection
