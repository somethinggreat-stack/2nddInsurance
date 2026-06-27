@extends('layouts.app')
@php $site = config('site'); @endphp
@section('title', 'Client Reviews')
@section('description', 'Read reviews from Michigan families and businesses who trust Patrick Yasso for their Auto, Home, Life and Business insurance.')

@section('content')

@include('partials.page-hero', ['heading' => 'Client Reviews', 'sub' => 'Real stories from Michigan families and businesses who trust Patrick with what matters most.', 'crumb' => 'Reviews'])

<section class="section">
    <div class="container">
        <div class="reveal" style="text-align:center;margin-bottom:2.5rem">
            <div class="testi__stars" style="justify-content:center;font-size:1.6rem"><x-icon name="star" /><x-icon name="star" /><x-icon name="star" /><x-icon name="star" /><x-icon name="star" /></div>
            <p class="lead" style="margin-top:.6rem"><strong>{{ $site['reviews_rating'] }} / 5</strong> from <strong>{{ $site['reviews_count'] }}</strong> verified reviews on Farmers.com</p>
        </div>
        @include('partials.sections.testimonials')

        <div class="btn-row center mt-4 reveal">
            <a href="{{ $site['reviews_url'] }}" target="_blank" rel="noopener" class="btn btn--primary btn--lg">See All {{ $site['reviews_count'] }} Reviews <x-icon name="arrow-right" /></a>
        </div>
    </div>
</section>

@include('partials.sections.cta-band', ['heading' => 'Join hundreds of protected Michigan families', 'sub' => 'Experience the difference of a dedicated local agent. Get your free quote today.'])

@endsection
