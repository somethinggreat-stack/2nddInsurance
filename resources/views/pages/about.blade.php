@extends('layouts.app')
@php $site = config('site'); @endphp
@section('title', 'About Us')
@section('description', 'About Quote Shark Michigan — Michigan insurance led by President Patrick Yasso and sponsored by Farmers Insurance. Personalized Auto, Home, Life and Business coverage statewide.')

@section('content')

@include('partials.page-hero', ['heading' => 'About ' . $site['brand'], 'sub' => 'Michigan insurance built around real people — led by our President, ' . $site['agent'] . ', and sponsored by Farmers Insurance.', 'crumb' => 'About'])

<section class="section">
    <div class="container">
        <div class="split">
            <div class="split__media reveal">
                <div class="media-frame">
                    <img src="{{ asset('images/agent-large.jpg') }}" alt="{{ $site['agent'] }}, President of {{ $site['brand'] }}" width="800" height="688">
                    <div class="exp-badge"><b>President</b><span>{{ $site['agent'] }}</span></div>
                </div>
            </div>
            <div class="split__copy reveal" data-delay="1">
                <span class="eyebrow"><x-icon name="user" /> Meet Our President</span>
                <h2>{{ $site['agent'] }}</h2>
                <p class="lead">As President of {{ $site['brand'] }} and a licensed Michigan insurance agent sponsored by {{ $site['company'] }}, Patrick built this company on a simple belief: insurance should be simple, honest, and built around real people — not policies sold from a script.</p>
                <p>With 20+ years of experience, Patrick and the team take the time to understand your life, your family, and your goals, then find coverage that genuinely fits — and stay right here when you need it most.</p>
                <ul class="check-list">
                    <li><x-icon name="check" /> Local Michigan expertise, statewide coverage</li>
                    <li><x-icon name="check" /> Personalized coverage for Auto, Home, Life &amp; Business</li>
                    <li><x-icon name="check" /> Straightforward advice — no pressure, no jargon</li>
                    <li><x-icon name="check" /> A claims advocate who stays in your corner</li>
                </ul>
                <div class="btn-row mt-4">
                    <a href="{{ route('quote') }}" class="btn btn--primary">Get a Free Quote</a>
                    <a href="tel:{{ $site['phone_raw'] }}" class="btn btn--ghost"><x-icon name="phone" /> {{ $site['phone'] }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section bg-slate">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="shield" /> What We Cover</span>
            <h2>Insurance built around your life</h2>
            <p class="lead">From your first car to your family's future and your growing business — get the right protection at the right price.</p>
        </div>
        @include('partials.sections.services')
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="heart" /> What We Stand For</span>
            <h2>Values that guide every policy</h2>
        </div>
        <div class="cards-3">
            <article class="card reveal"><div class="card__ico ig-red"><x-icon name="shield" /></div><h3>Trust First</h3><p>Honest recommendations based on what's right for you — never on what sells. Your trust is everything.</p></article>
            <article class="card reveal" data-delay="1"><div class="card__ico ig-blue"><x-icon name="user" /></div><h3>Truly Personal</h3><p>You're a neighbor, not a number. We get to know you so your coverage actually fits your life.</p></article>
            <article class="card reveal" data-delay="2"><div class="card__ico ig-navy"><x-icon name="support" /></div><h3>Always Here</h3><p>From your first quote to your first claim, we're a phone call away — responsive, local, and reliable.</p></article>
        </div>
    </div>
</section>

<section class="section bg-slate">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="pin" /> Coverage Areas</span>
            <h2>Proudly serving Michigan</h2>
            <p class="lead">Based in {{ $site['city'] }} and helping clients across the region and beyond.</p>
        </div>
        <div class="reveal" style="display:flex;flex-wrap:wrap;gap:.7rem;justify-content:center;max-width:780px;margin-inline:auto">
            @foreach ($site['coverage_areas'] as $area)
                <span class="badge-soft"><x-icon name="pin" style="width:1em;height:1em" /> {{ $area }}</span>
            @endforeach
        </div>
    </div>
</section>

@include('partials.sections.cta-band', ['heading' => "Let's protect what matters most to you", 'sub' => 'Reach out today for a free, friendly conversation about your insurance needs.'])

@endsection
