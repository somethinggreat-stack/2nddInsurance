@php $site = config('site'); @endphp
<div class="steps">
    @foreach ($site['steps'] as $i => $s)
        <div class="step-box reveal" data-delay="{{ $i }}">
            <div class="step__num">{{ $i + 1 }}</div>
            <h3>{{ $s['title'] }}</h3>
            <p>{{ $s['text'] }}</p>
        </div>
        @if (! $loop->last)
            <div class="step-arrow" aria-hidden="true"><x-icon name="arrow-right" /></div>
        @endif
    @endforeach
</div>
