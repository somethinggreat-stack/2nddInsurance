@extends('layouts.app')
@php $site = config('site'); @endphp
@section('title', 'Terms of Use')
@section('description', 'Terms of Use for the ' . $site['agent'] . ' website.')

@section('content')

@include('partials.page-hero', ['heading' => 'Terms of Use', 'sub' => 'Last updated ' . date('F Y'), 'crumb' => 'Terms'])

<section class="section">
    <div class="container container-narrow" style="line-height:1.8;color:var(--slate-700)">
        <div class="stack reveal">
            <p>Welcome to the website of {{ $site['agent'] }}, an authorized {{ $site['company'] }} agent. By accessing or using this website, you agree to these Terms of Use.</p>

            <h2 style="font-size:1.4rem">Informational Purposes Only</h2>
            <p>The content on this site is provided for general informational purposes and does not constitute an offer of insurance, a contract, or a guarantee of coverage. Actual coverage, terms, eligibility, and pricing are determined by {{ $site['company'] }} and are subject to underwriting, policy terms, and applicable law.</p>

            <h2 style="font-size:1.4rem">Quotes &amp; Submissions</h2>
            <p>Quote requests and questionnaire submissions are requests to be contacted and do not bind you or us to any policy. Coverage is not in effect until a policy is issued and any required premium is paid.</p>

            <h2 style="font-size:1.4rem">Accuracy of Information</h2>
            <p>You agree to provide accurate and complete information. Quotes and recommendations are based on the information you supply and may change once verified.</p>

            <h2 style="font-size:1.4rem">Intellectual Property</h2>
            <p>{{ $site['company'] }} names, logos, and trademarks are the property of their respective owners and are used here in connection with an authorized agency. Other site content may not be reproduced without permission.</p>

            <h2 style="font-size:1.4rem">Limitation of Liability</h2>
            <p>This website is provided "as is." To the fullest extent permitted by law, we disclaim liability for any damages arising from your use of the site.</p>

            <h2 style="font-size:1.4rem">Contact</h2>
            <p>Questions about these Terms? Contact {{ $site['agent'] }} at <a href="mailto:{{ $site['email'] }}" class="text-red">{{ $site['email'] }}</a> or <a href="tel:{{ $site['phone_raw'] }}" class="text-red">{{ $site['phone'] }}</a>.</p>

            <p style="font-size:.9rem;color:var(--slate-500);margin-top:1.5rem">These Terms are a general template and should be reviewed by qualified legal counsel and aligned with {{ $site['company'] }} requirements before publishing.</p>
        </div>
    </div>
</section>

@endsection
