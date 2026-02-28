<!-- FLASH INFOS -->
@if(isset($flashInfos) && $flashInfos->count())
<div class="flash-infos">
  <div class="flash-infos__label">Flash Infos</div>
  <div class="flash-infos__track">
    <div class="flash-infos__content">
      @foreach($flashInfos as $info)
      <span class="flash-infos__item">&bull; {{ $info->content }}</span>
      @endforeach
      {{-- Duplication pour le défilement continu --}}
      @foreach($flashInfos as $info)
      <span class="flash-infos__item">&bull; {{ $info->content }}</span>
      @endforeach
    </div>
  </div>
</div>
@endif
