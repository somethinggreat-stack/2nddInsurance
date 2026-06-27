@php $site = config('site'); @endphp
<div class="steps">
    @foreach ($site['steps'] as $i => $s)
        <div class="step reveal" data-delay="{{ $i }}">
            @if (! $loop->last)<div class="step__connector"></div>@endif
            <div class="step__num">{{ $i + 1 }}</div>
            <h3>{{ $s['title'] }}</h3>
            <p>{{ $s['text'] }}</p>
        </div>
    @endforeach
</div>
