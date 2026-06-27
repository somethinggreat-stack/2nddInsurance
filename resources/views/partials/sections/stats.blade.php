@php $site = config('site'); @endphp
<div class="stats">
    @foreach ($site['stats'] as $i => $s)
        <div class="stat-card reveal" data-delay="{{ $i }}">
            <b data-count="{{ $s['n'] }}" data-suffix="{{ $s['suffix'] }}">0{{ $s['suffix'] }}</b>
            <span>{{ $s['label'] }}</span>
        </div>
    @endforeach
</div>
