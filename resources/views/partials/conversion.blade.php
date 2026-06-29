@php $site = config('site'); @endphp

{{-- Sticky bottom CTA (mobile) --}}
<div class="sticky-cta">
    <div class="sticky-cta__in">
        <div class="sticky-cta__txt">
            <b>Ready for a better rate?</b>
            <span>Free quote in minutes — no obligation.</span>
        </div>
        <a href="tel:{{ $site['phone_raw'] }}" class="btn btn--ghost btn--sm"><x-icon name="phone" /> Call</a>
        <a href="{{ route('quote') }}" class="btn btn--primary btn--sm">Free Quote</a>
    </div>
</div>

{{-- Floating action button --}}
<div class="fab">
    <button class="fab__main pulse" aria-label="Quick contact options">
        <x-icon name="chat" />
    </button>
    <div class="fab__menu">
        <a href="tel:{{ $site['phone_raw'] }}" class="fab__item"><x-icon name="phone" /> Call {{ $site['phone'] }}</a>
        <a href="sms:{{ $site['phone_raw'] }}" class="fab__item"><x-icon name="chat" /> Text Us</a>
        <a href="mailto:{{ $site['email'] }}" class="fab__item"><x-icon name="mail" /> Email</a>
        <a href="{{ route('quote') }}" class="fab__item"><x-icon name="bolt" /> Free Quote</a>
    </div>
</div>
