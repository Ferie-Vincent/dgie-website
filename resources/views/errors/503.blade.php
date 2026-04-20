@extends('front-end.layouts.app')

@section('title', 'Site en maintenance — DGIE')

@section('meta')
  <meta name="description" content="Le site est temporairement indisponible pour maintenance. Merci de réessayer dans quelques instants.">
  <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
  <!-- PAGE 503 -->
  <section class="page-404" id="main-content">
    <div class="page-404__code">503</div>
    <h1 class="page-404__title">Site en maintenance</h1>
    <p class="page-404__text">Le site est temporairement indisponible pour des opérations de maintenance. Merci de réessayer dans quelques instants.</p>
    <div class="page-404__actions">
      <a href="{{ url('/') }}" class="page-404__btn page-404__btn--primary">Retour à l'accueil</a>
      <a href="{{ url('/contact') }}" class="page-404__btn page-404__btn--secondary">Nous contacter</a>
    </div>
  </section>
@endsection
