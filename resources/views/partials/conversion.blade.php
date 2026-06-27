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

{{-- Exit-intent modal --}}
<div class="modal" id="exitModal" role="dialog" aria-modal="true" aria-labelledby="exitTitle">
    <div class="modal__scrim" data-close-modal></div>
    <div class="modal__card">
        <button class="modal__close" data-close-modal aria-label="Close"><x-icon name="x" /></button>
        <div class="modal__top">
            <x-icon name="sparkles" style="width:38px;height:38px;margin:0 auto .6rem;color:#ff9aa6" />
            <h3 id="exitTitle">Wait — Don't Overpay!</h3>
            <p style="color:#c2d0ee;margin-top:.4rem">See how much you could save with a free, no-obligation quote from {{ $site['agent'] }}.</p>
        </div>
        <div class="modal__body">
            <form action="{{ route('callback.store') }}" method="POST">
                @csrf
                <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">
                <div class="field">
                    <label for="ex_name">Your Name</label>
                    <input type="text" id="ex_name" name="name" placeholder="Full name" required>
                </div>
                <div class="field">
                    <label for="ex_phone">Phone Number</label>
                    <input type="tel" id="ex_phone" name="phone" placeholder="(248) 000-0000" required>
                </div>
                <button type="submit" class="btn btn--primary btn--block btn--lg">Get My Free Quote</button>
                <p style="text-align:center;font-size:.8rem;color:var(--slate-500);margin-top:.8rem">
                    <x-icon name="lock" style="width:.9em;height:.9em;display:inline" /> 100% free. No spam. Local Michigan service.
                </p>
            </form>
        </div>
    </div>
</div>
