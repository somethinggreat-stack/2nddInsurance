@extends('layouts.app')
@php $site = config('site'); @endphp

@section('content')

{{-- HERO --}}
<section class="hero">
    @php $sharkV = '?v=' . (@filemtime(public_path('images/shark.png')) ?: '1'); @endphp
    <div class="hero__sharks" aria-hidden="true">
        <img src="{{ asset('images/shark.png') }}{{ $sharkV }}" class="shark s1" alt="">
        <img src="{{ asset('images/shark.png') }}{{ $sharkV }}" class="shark s2" alt="">
        <img src="{{ asset('images/shark.png') }}{{ $sharkV }}" class="shark s3" alt="">
        <img src="{{ asset('images/shark.png') }}{{ $sharkV }}" class="shark s4" alt="">
        <img src="{{ asset('images/shark.png') }}{{ $sharkV }}" class="shark s5" alt="">
    </div>
    <div class="container">
        <div class="hero__grid">
            <div class="hero__copy">
                <div class="hero__badges">
                    <span class="chip"><x-icon name="pin" /> Insuring Now of Michigan</span>
                    <span class="chip"><x-icon name="shield" /> Farmers Insurance</span>
                </div>
                <h1>Protecting Michigan <span class="accent">Families &amp; Businesses</span></h1>
                <ul class="hero__list">
                    <li><x-icon name="check" /> Home</li>
                    <li><x-icon name="check" /> Auto</li>
                    <li><x-icon name="check" /> Life</li>
                    <li><x-icon name="check" /> Business</li>
                </ul>
                <p class="hero__lead">Insuring <strong style="color:#fff">all of Michigan</strong> — better coverage, better savings, from {{ $site['brand'] }}.</p>
                <div class="hero__cta btn-row">
                    <a href="#quiz" class="btn btn--primary btn--lg">Get My Free Quote <x-icon name="arrow-right" /></a>
                    <a href="tel:{{ $site['phone_raw'] }}" class="btn btn--white btn--lg"><x-icon name="phone" /> {{ $site['phone'] }}</a>
                </div>
            </div>

            <div class="hero__media">
                @include('partials.michigan-map')
            </div>
        </div>
    </div>
</section>

{{-- QUESTIONNAIRE --}}
<section class="section bg-slate" id="quiz" style="padding-top:clamp(2.4rem,4vw,3.4rem)">
    <div class="container">
        <div class="section-head center reveal" style="margin-bottom:1.2rem">
            <span class="eyebrow"><x-icon name="clipboard" /> Free Personalized Quote</span>
            <h2 style="font-size:clamp(2.5rem,5.5vw,3.7rem)">Get Quoted Now</h2>
            <p class="lead">Answer a few quick questions and we'll prepare Michigan insurance options tailored to you — takes about 2 minutes, no obligation.</p>
        </div>
        <div class="form-glow reveal" style="max-width:960px;margin-inline:auto">
            <div class="form-card">
                @if ($errors->any())
                    <div class="quiz" style="margin-bottom:1.4rem">@include('partials.alerts')</div>
                @endif
                @include('partials.questionnaire-form')
            </div>
        </div>
    </div>
</section>

{{-- DON'T LET LIFE EAT YOU ALIVE (shark CTA) --}}
<section class="section shark-cta">
    <div class="container">
        <div class="split">
            <div class="split__copy reveal">
                <span class="eyebrow"><x-icon name="shield" /> Be Insured. Be Protected.</span>
                <h2>Don't Let Life <span class="accent">Eat You Alive</span></h2>
                <p class="lead">Life comes at you fast. One accident, storm, illness, or lawsuit can take a bite out of everything you've built — your home, your car, your savings, and your family's future.</p>
                <p style="color:var(--slate-600)">{{ $site['brand'] }} wraps it all under one roof, so life's surprises never sink you. Get protected in minutes — sponsored by Farmers Insurance and backed by a dedicated Michigan team.</p>
                <ul class="check-list">
                    <li><x-icon name="check" /> Protect your home, car &amp; belongings</li>
                    <li><x-icon name="check" /> Shield your income &amp; your family's future</li>
                    <li><x-icon name="check" /> Cover your business &amp; liability</li>
                </ul>
                <div class="btn-row mt-4">
                    <a href="#quiz" class="btn btn--primary btn--lg">Get My Free Quote <x-icon name="arrow-right" /></a>
                    <a href="tel:{{ $site['phone_raw'] }}" class="btn btn--navy btn--lg"><x-icon name="phone" /> {{ $site['phone'] }}</a>
                </div>
            </div>
            <div class="split__media reveal" data-delay="1">
                <div class="shark-cta__img">
                    <img src="{{ asset('images/sharkeating.png') }}?v={{ @filemtime(public_path('images/sharkeating.png')) ?: '1' }}" alt="Don't let life eat you alive — be insured, be protected with {{ $site['brand'] }}" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- WHAT WE COVER — sticky services (left fixed, right scrolls) --}}
<section class="section bg-navy svc2-section">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="shield" /> What We Cover</span>
            <h2>Michigan insurance for every part of life</h2>
            <p class="lead">Comprehensive coverage designed to protect your family, your home, and your business across all of Michigan.</p>
        </div>

        @php
            $ov = [
                'red'  => 'linear-gradient(150deg, rgba(140,10,24,.90) 0%, rgba(200,17,39,.66) 100%)',
                'navy' => 'linear-gradient(150deg, rgba(2,31,87,.92) 0%, rgba(10,58,134,.66) 100%)',
                'blue' => 'linear-gradient(150deg, rgba(2,49,113,.90) 0%, rgba(7,99,196,.64) 100%)',
            ];
            $svc = [
                ['icon' => 'home',      'tone' => 'red',  'img' => 'svc-home.jpg',         'title' => 'Home Insurance',        'text' => ["Safeguard your home and everything inside it against fire, theft, storms, and the unexpected — from the roof over your head to the belongings that make it home.", "We cover your dwelling, personal property, and liability with replacement-cost options, so if the worst happens you can rebuild without cutting a single corner."]],
                ['icon' => 'car',       'tone' => 'navy', 'img' => 'svc-auto.jpg',         'title' => 'Auto Insurance',        'text' => ["Protect every drive with coverage tailored to Michigan roads, rates, and state requirements — built around how you actually drive and what you actually drive.", "From liability and full coverage to accident forgiveness and roadside assistance, we shape a policy that fits both your life and your monthly budget."]],
                ['icon' => 'layers',    'tone' => 'blue', 'img' => 'svc-bundle.jpg',       'title' => 'Home & Auto Bundle',    'text' => ["Combine home and auto into one simple policy and unlock meaningful multi-policy discounts — one bill, one login, and one dedicated team behind it all.", "You get coordinated coverage that quietly closes the gaps most people miss, making it the easiest way to save more while worrying a whole lot less."]],
                ['icon' => 'sofa',      'tone' => 'red',  'img' => 'svc-renters.jpg',      'title' => 'Renters Insurance',     'text' => ["Affordable protection for your belongings and personal liability in any Michigan rental — covering furniture, electronics, and valuables against theft and damage.", "It even includes liability and loss-of-use if you're ever displaced, often for just a few dollars a month. Small cost, and serious peace of mind."]],
                ['icon' => 'layers',    'tone' => 'navy', 'img' => 'svc-renters-auto.jpg', 'title' => 'Renters & Auto Bundle', 'text' => ["Pair renters and auto coverage for automatic discounts and one easy point of contact — your car and your belongings protected under a single simple plan.", "Simplify your billing, keep more money in your pocket each month, and lean on one dedicated team that actually knows you by name when you call."]],
                ['icon' => 'heart',     'tone' => 'blue', 'img' => 'svc-life.jpg',         'title' => 'Life Insurance',        'text' => ["Give your family lasting financial security and genuine peace of mind with term or whole life coverage tailored to your goals and your stage of life.", "From income protection and final-expense coverage to living benefits you can use today, we help you leave the people you love protected, never burdened."]],
                ['icon' => 'briefcase', 'tone' => 'red',  'img' => 'svc-business.jpg',     'title' => 'Business Insurance',    'text' => ["Keep your Michigan business moving forward with liability, commercial property, workers' comp, and commercial auto — coverage that scales right along as you grow.", "Whether you're a local shop, a busy contractor, or a growing team, we tailor protection around everything you have worked so hard to build."]],
            ];
        @endphp

        <div class="svc2">
            <div class="svc2__left reveal">
                <h3>Coverage built around your Michigan life</h3>
                <p>From your first car to your family's future and your growing business, {{ $site['brand'] }} makes protection simple, honest, and personal.</p>
                <p>Sponsored by Farmers Insurance, we pair big-carrier strength with local Michigan service — one dedicated team that's with you from your first quote to your first claim.</p>
                <ul class="svc2__bullets">
                    <li><x-icon name="check" /> Statewide Michigan coverage</li>
                    <li><x-icon name="check" /> Bundle &amp; save across multiple policies</li>
                    <li><x-icon name="check" /> One dedicated team, real claims support</li>
                </ul>
                <a href="#quiz" class="btn btn--primary btn--lg">Get My Free Quote <x-icon name="arrow-right" /></a>
            </div>

            <div class="svc2__right">
                @foreach ($svc as $i => $s)
                    <article class="svc2-card reveal" style="background-image: {{ $ov[$s['tone']] }}, url('{{ asset('images/'.$s['img']) }}?v={{ @filemtime(public_path('images/'.$s['img'])) ?: '1' }}');">
                        <span class="svc2-card__wm"><x-icon :name="$s['icon']" /></span>
                        <div class="svc2-card__top">
                            <h3>{{ $s['title'] }}</h3>
                            <span class="svc2-card__num">{{ sprintf('%02d', $i + 1) }}</span>
                        </div>
                        @foreach ($s['text'] as $para)<p>{{ $para }}</p>@endforeach
                        <div class="svc2-card__foot">
                            <a href="#quiz" class="svc2-card__link">Get a Quote</a>
                            <a href="#quiz" class="svc2-card__arrow" aria-label="Get a {{ $s['title'] }} quote"><x-icon name="arrow-right" /></a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ABOUT TEASER (company) --}}
<section class="section">
    <div class="container">
        <div class="split">
            <div class="split__media reveal">
                <div class="media-frame">
                    <img src="{{ asset('images/protection.png') }}?v={{ @filemtime(public_path('images/protection.png')) ?: '1' }}" alt="Protection built around your life — home, life, and auto coverage from {{ $site['brand'] }}" width="800" height="620">
                </div>
            </div>
            <div class="split__copy reveal" data-delay="1">
                <span class="eyebrow"><x-icon name="shield" /> Who We Are</span>
                <h2>Insurance done the personal way</h2>
                <p class="lead" style="font-size:1.12rem">{{ $site['brand'] }} makes protecting what matters simple, honest, and built around real people. Led by President {{ $site['agent'] }} and sponsored by Farmers Insurance, we insure families and businesses across all of Michigan with coverage that actually fits.</p>
                <ul class="check-list">
                    <li><x-icon name="check" /> One dedicated team — no call centers</li>
                    <li><x-icon name="check" /> Coverage tailored to Michigan families &amp; businesses</li>
                    <li><x-icon name="check" /> A real advocate when it's time to file a claim</li>
                </ul>
                <div class="btn-row mt-4">
                    <a href="{{ route('about') }}" class="btn btn--navy">About Us <x-icon name="arrow-right" /></a>
                    <a href="{{ route('consultation') }}" class="btn btn--ghost">Schedule a Chat</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- WHY US --}}
<section class="section bg-navy" style="background-image: linear-gradient(180deg, rgba(2,31,87,.90) 0%, rgba(2,31,87,.84) 45%, rgba(2,31,87,.93) 100%), url('{{ asset('images/why-bg.jpg') }}?v={{ @filemtime(public_path('images/why-bg.jpg')) ?: '1' }}'); background-size:cover; background-position:center;">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="sparkles" /> Why Choose Us</span>
            <h2>The local advantage you deserve</h2>
            <p>Big-company strength. Small-town service. Here's what sets working with us apart.</p>
        </div>
        <div class="cards-3">
            @foreach ($site['reasons'] as $i => $r)
                <article class="card reveal" data-delay="{{ $i % 3 }}" style="background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.1)">
                    <div class="card__ico {{ ['ig-red','ig-blue','ig-navy'][$i % 3] }}"><x-icon :name="$r['icon']" /></div>
                    <h3 style="color:#fff">{{ $r['title'] }}</h3>
                    <p style="color:#b9c6e6">{{ $r['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- HOW IT WORKS --}}
<section class="section bg-slate">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="rocket" /> How It Works</span>
            <h2>Getting covered is easy</h2>
            <p class="lead">Three simple steps to the right coverage and lasting peace of mind.</p>
        </div>
        @include('partials.sections.steps')
    </div>
</section>

{{-- BEFORE vs AFTER --}}
<section class="section bg-navy" id="compare" style="background-image: linear-gradient(180deg, rgba(2,31,87,.91) 0%, rgba(2,31,87,.85) 45%, rgba(2,31,87,.94) 100%), url('{{ asset('images/compare-bg.jpg') }}?v={{ @filemtime(public_path('images/compare-bg.jpg')) ?: '1' }}'); background-size:cover; background-position:center;">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="sparkles" /> The Difference</span>
            <h2>Before Quote Shark <span style="color:#ff9aa6">vs.</span> After Quote Shark</h2>
            <p>See exactly what changes the moment you switch to a dedicated team that has your back.</p>
        </div>

        <div class="vs-grid reveal">
            <div class="vs-card vs-card--before">
                <div class="vs-card__title">Before</div>
                <ul class="vs-list">
                    <li><span class="vs-emoji">😟</span> Paying too much</li>
                    <li><span class="vs-emoji">📞</span> Long call-center wait times</li>
                    <li><span class="vs-emoji">❓</span> Confusing coverage</li>
                    <li><span class="vs-emoji">😰</span> Stress during claims</li>
                    <li><span class="vs-emoji">📄</span> Multiple policies everywhere</li>
                    <li><span class="vs-emoji">⚠️</span> Unsure if you're covered</li>
                </ul>
            </div>

            <div class="vs-mid">
                <span class="vs-arrow"><x-icon name="arrow-right" /></span>
            </div>

            <div class="vs-card vs-card--after">
                <div class="vs-card__title">After <span class="tag">With Quote Shark</span></div>
                <ul class="vs-list">
                    <li><span class="vs-emoji">💰</span> Better rates &amp; discounts</li>
                    <li><span class="vs-emoji">👤</span> One dedicated local agent</li>
                    <li><span class="vs-emoji">✅</span> Personalized protection</li>
                    <li><span class="vs-emoji">🤝</span> A claims advocate by your side</li>
                    <li><span class="vs-emoji">📦</span> Simple bundled coverage</li>
                    <li><span class="vs-emoji">🛡️</span> Confidence &amp; peace of mind</li>
                </ul>
            </div>
        </div>

        <div class="btn-row center mt-4 reveal">
            <a href="#quiz" class="btn btn--primary btn--lg">See How Much You Could Save <x-icon name="arrow-right" /></a>
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="section">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="quote" /> Client Reviews</span>
            <h2>Michigan families love working with us</h2>
            <p class="lead">Real service. Real savings. Real relationships.</p>
        </div>
        @include('partials.sections.testimonials', ['limit' => 3])
        <div class="btn-row center mt-4">
            <a href="{{ route('testimonials') }}" class="btn btn--ghost">Read More Reviews <x-icon name="arrow-right" /></a>
        </div>
    </div>
</section>

@endsection
