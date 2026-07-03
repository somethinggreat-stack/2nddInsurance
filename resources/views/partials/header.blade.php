@php $site = config('site'); @endphp
<header class="site-header">
    <div class="container navbar">
        <a href="{{ route('home') }}" class="brand" aria-label="{{ $site['brand'] }} home">
            <img src="{{ asset('images/personallogo.png') }}?v={{ @filemtime(public_path('images/personallogo.png')) ?: '1' }}" alt="{{ $site['brand'] }}" class="brand__logo" width="210" height="54">
        </a>

        <nav class="nav-links" aria-label="Primary">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('products') }}" class="{{ request()->routeIs('products') || request()->routeIs('services') ? 'active' : '' }}">Insurance</a>
            <a href="{{ route('why-us') }}" class="{{ request()->routeIs('why-us') ? 'active' : '' }}">Why Us</a>
            <a href="{{ route('testimonials') }}" class="{{ request()->routeIs('testimonials') ? 'active' : '' }}">Reviews</a>
            <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </nav>

        <div class="nav-cta">
            <a href="tel:{{ $site['phone_raw'] }}" class="nav-phone"><x-icon name="phone" /> {{ $site['phone'] }}</a>
            <a href="{{ route('quote') }}" class="btn btn--primary btn--sm">Get a Quote</a>
            <button class="nav-toggle" aria-label="Open menu" aria-expanded="false">
                <x-icon name="menu" />
            </button>
        </div>
    </div>
</header>

{{-- Mobile drawer --}}
<div class="mobile-nav" id="mobileNav">
    <div class="mobile-nav__scrim" data-close-nav></div>
    <div class="mobile-nav__panel">
        <div class="mobile-nav__head">
            <img src="{{ asset('images/personallogo.png') }}?v={{ @filemtime(public_path('images/personallogo.png')) ?: '1' }}" alt="{{ $site['brand'] }}" style="height:44px;width:auto">
            <button class="mobile-nav__close" data-close-nav aria-label="Close menu"><x-icon name="x" /></button>
        </div>
        <a href="{{ route('home') }}" data-close-nav>Home</a>
        <a href="{{ route('about') }}" data-close-nav>About Us</a>
        <a href="{{ route('products') }}" data-close-nav>Insurance Products</a>
        <a href="{{ route('services') }}" data-close-nav>Services</a>
        <a href="{{ route('why-us') }}" data-close-nav>Why Choose Us</a>
        <a href="{{ route('testimonials') }}" data-close-nav>Reviews</a>
        <a href="{{ route('faq') }}" data-close-nav>FAQ</a>
        <a href="{{ route('contact') }}" data-close-nav>Contact</a>
        <div style="margin-top:1rem;display:grid;gap:.6rem">
            <a href="{{ route('questionnaire') }}" class="btn btn--navy btn--block" data-close-nav>Start Questionnaire</a>
            <a href="{{ route('quote') }}" class="btn btn--primary btn--block" data-close-nav>Get a Free Quote</a>
            <a href="tel:{{ $site['phone_raw'] }}" class="btn btn--ghost btn--block" data-close-nav><x-icon name="phone" /> {{ $site['phone'] }}</a>
        </div>
    </div>
</div>
