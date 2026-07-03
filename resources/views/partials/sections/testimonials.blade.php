@php
    $site = config('site');
    $items = isset($limit) ? array_slice($site['testimonials'], 0, $limit) : $site['testimonials'];
    $women  = ['w1', 'w2', 'w3', 'w4', 'w5'];
    $men    = ['m1', 'm2', 'm3', 'm4', 'm5'];
    $female = ['Colleen', 'Sahira', 'Mary', 'Lauren', 'Sheryl', 'Melodi', 'Julia', 'Lynn'];
@endphp
<div class="cards-3">
    @foreach ($items as $i => $t)
        @php
            $first  = \Illuminate\Support\Str::of($t['name'])->before(' ')->__toString();
            $pool   = in_array($first, $female) ? $women : $men;
            $avatar = $pool[$i % count($pool)];
        @endphp
        <figure class="testi reveal" data-delay="{{ $i % 3 }}">
            <div class="testi__stars" aria-label="{{ $t['rating'] }} out of 5 stars">
                @for ($s = 0; $s < $t['rating']; $s++)<x-icon name="star" />@endfor
            </div>
            <blockquote class="testi__quote">"{{ $t['quote'] }}"</blockquote>
            <figcaption class="testi__by">
                <img src="{{ asset('images/people/' . $avatar . '.jpg') }}" class="testi__avatar" alt="{{ $t['name'] }}" width="48" height="48" loading="lazy">
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
