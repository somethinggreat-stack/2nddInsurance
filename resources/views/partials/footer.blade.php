@php $site = config('site'); @endphp
<footer class="footer">
    <div class="container">
        <div class="footer__grid">
            <div class="footer__brand">
                <a href="{{ route('home') }}" class="brand" aria-label="{{ $site['brand'] }} home" style="background:#fff;padding:.55rem .9rem;border-radius:14px;display:inline-flex;box-shadow:var(--sh-sm);margin-bottom:1rem">
                    <img src="{{ asset('images/personallogo.png') }}?v={{ @filemtime(public_path('images/personallogo.png')) ?: '1' }}" alt="{{ $site['brand'] }}" style="height:42px;width:auto">
                </a>
                <p class="footer__desc">{{ $site['tagline'] }}. Personalized Auto, Home, Life & Business coverage, backed by the strength of Farmers Insurance.</p>
                <div class="agent-badge" style="margin-bottom:1.1rem">
                    <img src="{{ asset('images/logo.png') }}" alt="Farmers Insurance" style="filter:brightness(0) invert(1);opacity:.92">
                    <span class="lbl" style="color:#8ea0c8">Authorized Agent</span>
                </div>
                <div class="socials">
                    <a class="soc soc--fb" href="{{ $site['socials']['facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook"><x-icon name="facebook" /></a>
                    <a class="soc soc--ig" href="{{ $site['socials']['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram"><x-icon name="instagram" /></a>
                    <a class="soc soc--li" href="{{ $site['socials']['linkedin'] }}" target="_blank" rel="noopener" aria-label="LinkedIn"><x-icon name="linkedin" /></a>
                    <a class="soc soc--farmers" href="{{ $site['reviews_url'] }}" target="_blank" rel="noopener" aria-label="{{ $site['agent'] }} on Farmers.com"><img src="{{ asset('images/farmers-mark.png') }}" alt="Farmers Insurance profile"></a>
                </div>
            </div>

            <div>
                <h4>Insurance</h4>
                <div class="footer__links">
                    @foreach ($site['services'] as $s)
                        <a href="{{ route('products') }}#{{ $s['key'] }}">{{ $s['title'] }}</a>
                    @endforeach
                    <a href="{{ route('quote') }}">Get a Quote</a>
                </div>
            </div>

            <div>
                <h4>Company</h4>
                <div class="footer__links">
                    <a href="{{ route('about') }}">About Us</a>
                    <a href="{{ route('why-us') }}">Why Choose Us</a>
                    <a href="{{ route('testimonials') }}">Client Reviews</a>
                    <a href="{{ route('faq') }}">FAQ</a>
                    <a href="{{ route('questionnaire') }}">Insurance Questionnaire</a>
                    <a href="{{ route('contact') }}">Contact</a>
                </div>
            </div>

            <div>
                <h4>Get In Touch</h4>
                <ul class="footer__contact">
                    <li><x-icon name="location" /><span>{{ $site['address'] }},<br>{{ $site['city'] }}, {{ $site['state'] }} {{ $site['zip'] }}</span></li>
                    <li><x-icon name="phone" /><a href="tel:{{ $site['phone_raw'] }}">{{ $site['phone'] }}</a></li>
                    <li><x-icon name="mail" /><a href="mailto:{{ $site['email'] }}">{{ $site['email'] }}</a></li>
                    <li><x-icon name="clock" /><span>Mon–Fri: 9:00 AM – 6:00 PM</span></li>
                </ul>
            </div>
        </div>

        <div class="footer__bottom">
            <div>© <span data-year>{{ date('Y') }}</span> {{ $site['brand'] }}. {{ $site['license'] }}.</div>
            <div style="display:flex;gap:1.2rem;flex-wrap:wrap">
                <a href="{{ route('privacy') }}">Privacy Policy</a>
                <a href="{{ route('terms') }}">Terms</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
        </div>
        <p style="font-size:.74rem;color:#7e8db5;padding-bottom:1.6rem;max-width:80ch">
            {{ $site['brand'] }} — insurance products offered through licensed {{ $site['company'] }} agents. Coverage subject to policy terms, conditions, and availability. This site is for informational purposes and does not constitute a contract or guarantee of coverage.
        </p>
    </div>
</footer>
