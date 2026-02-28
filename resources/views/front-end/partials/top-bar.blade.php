<!-- TOP BAR -->
<div class="top-bar">
  <div class="container">
    <div class="top-bar__left">
      <span class="top-bar__item">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        {{ isset($contactInfo) && $contactInfo ? $contactInfo->phone_1 : '+225 XX XX XX XX XX' }}
      </span>
      <span class="top-bar__item">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        {{ isset($contactInfo) && $contactInfo ? $contactInfo->email : 'contact@dgie.gouv.ci' }}
      </span>
    </div>
    <div class="top-bar__right">
      <span class="top-bar__item">Lun – Ven : 8h00 – 16h30</span>
      <div class="top-bar__flag">
        <span class="top-bar__flag-stripe top-bar__flag-stripe--orange"></span>
        <span class="top-bar__flag-stripe top-bar__flag-stripe--white"></span>
        <span class="top-bar__flag-stripe top-bar__flag-stripe--green"></span>
      </div>
    </div>
  </div>
</div>
