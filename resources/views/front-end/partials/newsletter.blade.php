<!-- NEWSLETTER -->
<section class="newsletter-section">
  <div class="container">
    <div class="newsletter-section__card">
      <div class="newsletter-section__icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
      </div>
      <h2 class="newsletter-section__title">Restez informé</h2>
      <p class="newsletter-section__desc">Recevez nos actualités, événements et opportunités directement dans votre boîte mail.</p>

      @if(session('newsletter_success'))
      <p class="newsletter-section__success" style="display:block;">{{ session('newsletter_success') }}</p>
      @endif

      <form class="newsletter-section__form" action="{{ route('newsletter.subscribe') }}" method="POST">
        @csrf
        <div class="newsletter-section__input-group">
          <svg class="newsletter-section__input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
          <label for="newsletterEmail" class="sr-only">Votre adresse e-mail</label>
          <input type="email" name="email" placeholder="Votre adresse e-mail" class="newsletter-section__input" id="newsletterEmail" required value="{{ old('email') }}">
        </div>
        <button type="submit" class="newsletter-section__btn">S'inscrire</button>
        @error('email')
        <p class="newsletter-section__error" style="color:#e53e3e;font-size:.85rem;margin-top:.5rem;">{{ $message }}</p>
        @enderror
      </form>
      <p class="newsletter-section__privacy">Vos données sont protégées. Pas de spam, promis.</p>
    </div>
  </div>
</section>
