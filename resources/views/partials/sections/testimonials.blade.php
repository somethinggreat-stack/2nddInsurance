@php
    $site = config('site');
    $items = isset($limit) ? array_slice($site['testimonials'], 0, $limit) : $site['testimonials'];
@endphp
<div class="cards-3">
    @foreach ($items as $i => $t)
        <figure class="testi reveal" data-delay="{{ $i % 3 }}">
            <div class="testi__stars" aria-label="{{ $t['rating'] }} out of 5 stars">
                @for ($s = 0; $s < $t['rating']; $s++)<x-icon name="star" />@endfor
            </div>
            <blockquote class="testi__quote">"{{ $t['quote'] }}"</blockquote>
            <figcaption class="testi__by">
                <span class="testi__avatar">{{ strtoupper(substr($t['name'], 0, 1)) }}</span>
                <span>
                    <b>{{ $t['name'] }}</b>
                    <span class="testi__meta">
                        @isset($t['date']){{ $t['date'] }} · @endisset<span class="testi__verified"><x-icon name="check-circle" /> Verified</span>
                    </span>
                </span>
            </figcaption>
        </figure>
    @endforeach
</div>
