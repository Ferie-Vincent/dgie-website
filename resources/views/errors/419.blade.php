@extends('front-end.layouts.app')

@section('title', 'Session expirée — DGIE')

@section('content')
<main id="main-content">
  <section class="error-page" style="min-height: 60vh; display: flex; align-items: center; justify-content: center; padding: 4rem 1rem; text-align: center;">
    <div>
      <h1 style="font-size: 5rem; font-weight: 800; color: var(--orange); margin-bottom: 0.5rem;">419</h1>
      <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--slate-800); margin-bottom: 1rem;">Session expirée</h2>
      <p style="color: var(--slate-600); max-width: 480px; margin: 0 auto 2rem;">
        Votre session a expiré. Veuillez rafraîchir la page et réessayer.
      </p>
      <a href="{{ url()->previous() }}" class="btn btn--primary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: var(--orange); color: #fff; border-radius: 8px; text-decoration: none; font-weight: 600;">
        Rafraîchir la page
      </a>
    </div>
  </section>
</main>
@endsection
