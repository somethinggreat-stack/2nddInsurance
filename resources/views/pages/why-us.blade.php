@extends('layouts.app')
@php $site = config('site'); @endphp
@section('title', 'Why Choose Us')
@section('description', 'Why Michigan families choose Quote Shark Michigan — a dedicated local team sponsored by Farmers Insurance, personalized service, smart savings, and real claims support.')

@section('content')

@include('partials.page-hero', ['heading' => 'Why Choose ' . $site['brand'], 'sub' => 'Big-company strength meets small-town Michigan service. Here is the difference a dedicated local team makes.', 'crumb' => 'Why Us'])

<section class="section">
    <div class="container">
        <div class="cards-3">
            @foreach ($site['reasons'] as $i => $r)
                <article class="card card--accent reveal" data-delay="{{ $i % 3 }}">
                    <div class="card__ico {{ ['ig-red','ig-blue','ig-navy'][$i % 3] }}"><x-icon :name="$r['icon']" /></div>
                    <h3>{{ $r['title'] }}</h3>
                    <p>{{ $r['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section bg-navy">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="badge" /> By The Numbers</span>
            <h2>A track record you can trust</h2>
        </div>
        @include('partials.sections.stats')
    </div>
</section>

{{-- Comparison --}}
<section class="section">
    <div class="container container-narrow">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="eye" /> The Difference</span>
            <h2>Local agent vs. 1-800 number</h2>
        </div>
        <div class="cards-2 reveal">
            <div class="card" style="border-color:var(--slate-200)">
                <h3 style="color:var(--slate-500);font-size:1.2rem">A Faceless Call Center</h3>
                <div style="display:grid;gap:.8rem;margin-top:1rem;color:var(--slate-600)">
                    <div style="display:flex;gap:.6rem"><x-icon name="x" class="text-red" /> A different rep every time you call</div>
                    <div style="display:flex;gap:.6rem"><x-icon name="x" class="text-red" /> Scripts instead of real advice</div>
                    <div style="display:flex;gap:.6rem"><x-icon name="x" class="text-red" /> No one who knows your story</div>
                    <div style="display:flex;gap:.6rem"><x-icon name="x" class="text-red" /> You're on your own at claim time</div>
                </div>
            </div>
            <div class="card" style="border:2px solid var(--red);box-shadow:var(--sh-md)">
                <h3 style="color:var(--navy);font-size:1.2rem">{{ $site['brand'] }}, Your Local Team</h3>
                <div style="display:grid;gap:.8rem;margin-top:1rem;color:var(--slate-700)">
                    <div style="display:flex;gap:.6rem"><x-icon name="check-circle" class="text-blue" /> One dedicated team who knows you</div>
                    <div style="display:flex;gap:.6rem"><x-icon name="check-circle" class="text-blue" /> Honest, personalized recommendations</div>
                    <div style="display:flex;gap:.6rem"><x-icon name="check-circle" class="text-blue" /> Local expertise in Michigan coverage</div>
                    <div style="display:flex;gap:.6rem"><x-icon name="check-circle" class="text-blue" /> A real advocate when you file a claim</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section bg-slate">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="quote" /> Client Reviews</span>
            <h2>Don't just take our word for it</h2>
        </div>
        @include('partials.sections.testimonials', ['limit' => 3])
    </div>
</section>

@include('partials.sections.cta-band')

@endsection
