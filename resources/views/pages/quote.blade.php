@extends('layouts.app')
@php
    $site = config('site');
    $preselect = request('type');
@endphp
@section('title', 'Get a Free Quote')
@section('description', 'Get a free, no-obligation insurance quote from Patrick Yasso, your local Michigan Farmers agent. Auto, Home, Life & Business — quick and easy.')

@section('content')

<section class="page-hero">
    <div class="container">
        <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>Get a Quote</span></nav>
        <div style="max-width:640px">
            <h1>Your Free Quote, In Minutes</h1>
            <p class="lead" style="color:#bccbea">Tell me a little about what you'd like to protect and I'll get you a personalized, no-obligation quote.</p>
            <div style="display:flex;gap:1.4rem;flex-wrap:wrap;margin-top:1.4rem">
                <span class="chip"><x-icon name="check" style="color:#7ef0a8" /> 100% Free</span>
                <span class="chip"><x-icon name="check" style="color:#7ef0a8" /> No Obligation</span>
                <span class="chip"><x-icon name="check" style="color:#7ef0a8" /> Local Michigan Agent</span>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container container-narrow">
        <div class="form-card reveal">
            @include('partials.alerts')
            <form action="{{ route('quote.store') }}" method="POST">
                @csrf
                <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

                <div class="field" style="margin-bottom:1.4rem">
                    <label>What would you like to insure? <span class="req">*</span></label>
                    <div class="choice-grid">
                        @foreach ($site['quote_options'] as $s)
                            <label class="choice">
                                <input type="checkbox" name="interests[]" value="{{ $s['title'] }}"
                                    {{ $preselect === $s['key'] || collect(old('interests'))->contains($s['title']) ? 'checked' : '' }}>
                                <span class="choice__box">
                                    <x-icon :name="$s['icon']" />
                                    <span class="t">{{ $s['title'] }}</span>
                                </span>
                                <span class="choice__check"><x-icon name="check" style="width:.8em;height:.8em" /></span>
                            </label>
                        @endforeach
                    </div>
                    @error('interests')<span class="err">{{ $message }}</span>@enderror
                </div>

                <div class="form-grid-2">
                    <div class="field">
                        <label for="name">Full Name <span class="req">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Smith" required>
                        @error('name')<span class="err">{{ $message }}</span>@enderror
                    </div>
                    <div class="field">
                        <label for="phone">Phone <span class="req">*</span></label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="(248) 000-0000" required>
                        @error('phone')<span class="err">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-grid-2">
                    <div class="field">
                        <label for="email">Email <span class="req">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" required>
                        @error('email')<span class="err">{{ $message }}</span>@enderror
                    </div>
                    <div class="field">
                        <label for="zip">ZIP Code</label>
                        <input type="text" id="zip" name="zip" value="{{ old('zip') }}" placeholder="48390">
                    </div>
                </div>
                <div class="field">
                    <label for="message">Anything else I should know?</label>
                    <textarea id="message" name="message" placeholder="Current coverage, specific needs, timing…">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn btn--primary btn--block btn--lg">Get My Free Quote <x-icon name="arrow-right" /></button>
                <p style="text-align:center;font-size:.82rem;color:var(--slate-500);margin-top:1rem">
                    <x-icon name="lock" style="width:.9em;height:.9em;display:inline" /> Your details are private and never sold. Prefer to talk? Call <a href="tel:{{ $site['phone_raw'] }}" class="text-red" style="font-weight:600">{{ $site['phone'] }}</a>.
                </p>
            </form>
        </div>

        <div class="reveal" style="text-align:center;margin-top:2rem">
            <p style="color:var(--slate-500)">Want a more tailored recommendation?
                <a href="{{ route('questionnaire') }}" class="text-red" style="font-weight:600">Take the full questionnaire →</a>
            </p>
        </div>
    </div>
</section>

@endsection
