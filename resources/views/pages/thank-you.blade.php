@extends('layouts.app')
@php $site = config('site'); $name = $lead['name'] ?? null; @endphp
@section('title', 'Thank You')
@section('description', 'Thank you for reaching out. Quote Shark Michigan will be in touch shortly with your personalized insurance options.')
@push('schema')<meta name="robots" content="noindex">@endpush

@section('content')

<section class="section" style="min-height:60vh;display:grid;place-items:center">
    <div class="container container-narrow" style="text-align:center">
        <div class="thanks-icon"><x-icon name="check" /></div>
        <span class="eyebrow" style="margin-inline:auto"><x-icon name="sparkles" /> Request Received</span>
        <h1 style="margin-top:1rem">Thank you{{ $name ? ', ' . \Illuminate\Support\Str::of($name)->before(' ') : '' }}!</h1>
        <p class="lead mx-auto" style="max-width:56ch;margin-top:1rem">Your request is in good hands. {{ $site['brand'] }} will personally review your details and reach out shortly with your tailored Michigan insurance options.</p>

        <div class="cards-3 mt-4" style="text-align:left">
            <div class="card"><div class="card__ico ig-red"><x-icon name="document" /></div><h3 style="font-size:1.15rem">We Review</h3><p>We personally review your needs to find the best coverage and savings.</p></div>
            <div class="card"><div class="card__ico ig-blue"><x-icon name="phone" /></div><h3 style="font-size:1.15rem">We Reach Out</h3><p>You'll hear from us soon — usually the same business day.</p></div>
            <div class="card"><div class="card__ico ig-navy"><x-icon name="shield" /></div><h3 style="font-size:1.15rem">You Get Covered</h3><p>Choose your plan with total confidence and peace of mind.</p></div>
        </div>

        <div class="card mt-4" style="background:var(--grad-navy-deep);border:0;color:#fff;max-width:560px;margin-inline:auto">
            <h3 style="color:#fff">Need to talk sooner?</h3>
            <p style="color:#bccbea">We're just a call or text away.</p>
            <div class="btn-row center mt-3">
                <a href="tel:{{ $site['phone_raw'] }}" class="btn btn--primary"><x-icon name="phone" /> {{ $site['phone'] }}</a>
                <a href="{{ route('home') }}" class="btn btn--white">Back to Home</a>
            </div>
        </div>
    </div>
</section>

@endsection
