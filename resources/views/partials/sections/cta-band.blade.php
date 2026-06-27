@php $site = config('site'); @endphp
<section class="section section--tight">
    <div class="container">
        <div class="cta-band reveal">
            <div class="cta-band__grid">
                <div>
                    <h2>{{ $heading ?? 'Ready to protect what matters most?' }}</h2>
                    <p>{{ $sub ?? 'Get a free, no-obligation quote today and discover how much you could save with a local Michigan agent who truly has your back.' }}</p>
                </div>
                <div class="btn-row">
                    <a href="{{ route('quote') }}" class="btn btn--white btn--lg">Get My Free Quote</a>
                    <a href="tel:{{ $site['phone_raw'] }}" class="btn btn--navy btn--lg"><x-icon name="phone" /> {{ $site['phone'] }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
