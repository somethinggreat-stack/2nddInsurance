@extends('layouts.app')
@php $site = config('site'); @endphp
@section('title', 'Privacy Policy')
@section('description', 'Privacy Policy for ' . $site['agent'] . ', Farmers Insurance agent. How we collect, use and protect your information.')

@section('content')

@include('partials.page-hero', ['heading' => 'Privacy Policy', 'sub' => 'Last updated ' . date('F Y'), 'crumb' => 'Privacy'])

<section class="section">
    <div class="container container-narrow" style="line-height:1.8;color:var(--slate-700)">
        <div class="stack reveal">
            <p>{{ $site['agent'] }} ("we," "us," or "our"), an authorized {{ $site['company'] }} agent, respects your privacy. This policy explains what information we collect through this website and how we use it.</p>

            <h2 style="font-size:1.4rem">Information We Collect</h2>
            <p>When you request a quote, schedule a consultation, complete our questionnaire, or contact us, we may collect information you provide such as your name, email address, phone number, mailing details, and information about the assets or coverage you'd like to insure.</p>

            <h2 style="font-size:1.4rem">How We Use Your Information</h2>
            <ul class="check-list">
                <li><x-icon name="check" /> To prepare and provide insurance quotes and recommendations</li>
                <li><x-icon name="check" /> To contact you about your request and your coverage</li>
                <li><x-icon name="check" /> To provide ongoing service, support, and policy administration</li>
                <li><x-icon name="check" /> To comply with applicable legal and regulatory requirements</li>
            </ul>

            <h2 style="font-size:1.4rem">Information Sharing</h2>
            <p>We do not sell your personal information. We may share information with {{ $site['company'] }} and its affiliated insurance providers as needed to deliver quotes and service your policies, and with service providers acting on our behalf, consistent with applicable law.</p>

            <h2 style="font-size:1.4rem">Data Security</h2>
            <p>We take reasonable measures to protect the information you provide. However, no method of transmission over the Internet is completely secure, and we cannot guarantee absolute security.</p>

            <h2 style="font-size:1.4rem">Your Choices</h2>
            <p>You may contact us at any time to update your information or to opt out of marketing communications.</p>

            <h2 style="font-size:1.4rem">Contact Us</h2>
            <p>Questions about this policy? Reach out to {{ $site['agent'] }} at <a href="mailto:{{ $site['email'] }}" class="text-red">{{ $site['email'] }}</a> or <a href="tel:{{ $site['phone_raw'] }}" class="text-red">{{ $site['phone'] }}</a>, or by mail at {{ $site['address'] }}, {{ $site['city'] }}, {{ $site['state'] }} {{ $site['zip'] }}.</p>

            <p style="font-size:.9rem;color:var(--slate-500);margin-top:1.5rem">This Privacy Policy is provided for general informational purposes and is a starting template. Please have it reviewed by qualified legal counsel and align it with {{ $site['company'] }} corporate privacy requirements before publishing.</p>
        </div>
    </div>
</section>

@endsection
