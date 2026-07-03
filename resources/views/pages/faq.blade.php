@extends('layouts.app')
@php $site = config('site'); @endphp
@section('title', 'Frequently Asked Questions')
@section('description', 'Answers to common questions about Auto, Home, Life and Business insurance with Quote Shark Michigan, sponsored by Farmers Insurance, serving all of Michigan.')

@section('content')

@include('partials.page-hero', ['heading' => 'Frequently Asked Questions', 'sub' => 'Everything you want to know about getting covered with a local Michigan agent.', 'crumb' => 'FAQ'])

<section class="section">
    <div class="container">
        @include('partials.sections.faq')
    </div>
</section>

<section class="section--tight">
    <div class="container">
        <div class="card reveal" style="text-align:center;max-width:680px;margin-inline:auto;background:var(--grad-navy-deep);border:0;color:#fff">
            <div class="card__ico ig-red" style="margin-inline:auto"><x-icon name="chat" /></div>
            <h3 style="color:#fff">Still have questions?</h3>
            <p style="color:#bccbea">We're happy to help — no pressure, just honest answers.</p>
            <div class="btn-row center mt-3">
                <a href="tel:{{ $site['phone_raw'] }}" class="btn btn--primary"><x-icon name="phone" /> {{ $site['phone'] }}</a>
                <a href="{{ route('contact') }}" class="btn btn--white">Send a Message</a>
            </div>
        </div>
    </div>
</section>

@include('partials.sections.cta-band')

@endsection
