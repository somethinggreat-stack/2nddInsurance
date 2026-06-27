@extends('layouts.app')
@php $site = config('site'); @endphp
@section('title', 'Our Services')
@section('description', 'How Patrick Yasso helps Michigan clients — free quotes, policy reviews, bundling, claims support and ongoing service from a dedicated local Farmers agent.')

@section('content')

@include('partials.page-hero', ['heading' => 'Our Services', 'sub' => 'More than policies — a complete, personal insurance experience from quote to claim.', 'crumb' => 'Services'])

<section class="section">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="sparkles" /> How I Help</span>
            <h2>Full-service insurance, the local way</h2>
            <p class="lead">Everything you need to get covered, stay covered, and feel confident along the way.</p>
        </div>
        <div class="cards-3">
            <article class="card reveal"><div class="card__ico ig-red"><x-icon name="bolt" /></div><h3>Free Quotes</h3><p>Fast, no-obligation quotes across Auto, Home, Life &amp; Business — by phone, online, or in person.</p></article>
            <article class="card reveal" data-delay="1"><div class="card__ico ig-blue"><x-icon name="document" /></div><h3>Policy Reviews</h3><p>A clear, honest review of your current coverage to find gaps, savings, and better options.</p></article>
            <article class="card reveal" data-delay="2"><div class="card__ico ig-navy"><x-icon name="wallet" /></div><h3>Bundling &amp; Savings</h3><p>Combine policies to simplify your life and unlock multi-policy discounts.</p></article>
            <article class="card reveal"><div class="card__ico ig-blue"><x-icon name="family" /></div><h3>Life &amp; Family Planning</h3><p>Thoughtful guidance to protect your family's financial future with the right life coverage.</p></article>
            <article class="card reveal" data-delay="1"><div class="card__ico ig-navy"><x-icon name="building" /></div><h3>Business Protection</h3><p>Coverage strategies that keep your Michigan business resilient and moving forward.</p></article>
            <article class="card reveal" data-delay="2"><div class="card__ico ig-red"><x-icon name="support" /></div><h3>Claims Support</h3><p>A real advocate who guides you through claims and follows up until you're taken care of.</p></article>
        </div>
    </div>
</section>

<section class="section bg-slate">
    <div class="container">
        <div class="section-head center reveal">
            <span class="eyebrow"><x-icon name="rocket" /> The Process</span>
            <h2>Simple from start to finish</h2>
        </div>
        @include('partials.sections.steps')
    </div>
</section>

@include('partials.sections.cta-band')

@endsection
