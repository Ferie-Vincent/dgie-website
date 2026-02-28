<!-- BANNIÈRE PUBLICITAIRE -->
@if(isset($bannerTop) && $bannerTop)
<div class="banner-pub">
  <a href="{{ $bannerTop->url ?? '#' }}" target="_blank" rel="noopener">
    <img src="{{ asset('storage/' . $bannerTop->image) }}" alt="{{ $bannerTop->alt_text ?? 'Espace publicitaire' }}" onerror="this.style.display='none'; this.parentElement.parentElement.classList.add('banner-pub--placeholder');">
  </a>
  <span class="banner-pub__label">{{ $bannerTop->title ?? 'Espace publicitaire' }}</span>
</div>
@else
<div class="banner-pub banner-pub--placeholder">
  <span class="banner-pub__label">Espace publicitaire</span>
</div>
@endif
