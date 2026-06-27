@php $items = config('site.quote_options'); @endphp
<div class="cards-grid">
    @foreach ($items as $i => $s)
        <article class="card card--accent reveal" data-delay="{{ $i % 4 }}" id="{{ $s['key'] }}">
            <div class="card__ico {{ $s['tone'] }}"><x-icon :name="$s['icon']" /></div>
            <h3>{{ $s['title'] }}</h3>
            <p>{{ $s['short'] }}</p>
            <ul class="check-list">
                @foreach ($s['points'] as $p)
                    <li><x-icon name="check" /> {{ $p }}</li>
                @endforeach
            </ul>
        </article>
    @endforeach
</div>
