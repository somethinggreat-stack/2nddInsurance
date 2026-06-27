@extends('layouts.app')
@php $site = config('site'); @endphp
@section('title', 'Insurance Products')
@section('description', 'Explore Auto, Home, Life and Business insurance products from Patrick Yasso, your local Farmers Insurance agent in Michigan. Get a free quote today.')

@section('content')

@include('partials.page-hero', ['heading' => 'Insurance Products', 'sub' => 'Comprehensive coverage options for every part of your life, tailored to Michigan families and businesses.', 'crumb' => 'Insurance'])

<section class="section">
    <div class="container">
        @include('partials.sections.services')
    </div>
</section>

{{-- Detailed product blocks --}}
@foreach ($site['services'] as $i => $s)
<section class="section {{ $i % 2 ? 'bg-slate' : '' }}" id="{{ $s['key'] }}-details">
    <div class="container">
        <div class="split {{ $i % 2 ? 'split--reverse' : '' }}">
            <div class="split__media reveal">
                <div class="card" style="padding:2rem">
                    <div class="card__ico {{ $s['tone'] }}" style="width:72px;height:72px"><x-icon :name="$s['icon']" style="width:36px;height:36px" /></div>
                    <h3 style="font-size:1.5rem">{{ $s['title'] }}</h3>
                    <p>{{ $s['short'] }}</p>
                    <div class="divider" style="margin:1.2rem 0"></div>
                    <div style="display:grid;gap:.7rem">
                        @foreach ($s['points'] as $p)
                            <div style="display:flex;gap:.6rem;align-items:center"><x-icon name="check-circle" class="text-blue" /> <span style="font-weight:600;color:var(--navy)">{{ $p }}</span></div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="split__copy reveal" data-delay="1">
                <span class="eyebrow"><x-icon :name="$s['icon']" /> {{ $s['title'] }}</span>
                <h2>{{ $s['title'] }} that fits your world</h2>
                <p class="lead">{{ $s['short'] }} I'll walk you through your options in plain English and help you choose coverage that protects you without overpaying.</p>
                <p>Bundle this with your other policies and you could unlock meaningful savings — ask me how much you could keep in your pocket.</p>
                <div class="btn-row mt-3">
                    <a href="{{ route('quote') }}?type={{ $s['key'] }}" class="btn btn--primary">Get {{ $s['title'] }} Quote <x-icon name="arrow-right" /></a>
                    <a href="tel:{{ $site['phone_raw'] }}" class="btn btn--ghost"><x-icon name="phone" /> Call to Discuss</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach

@include('partials.sections.cta-band', ['heading' => 'Not sure which coverage you need?', 'sub' => "Take our quick questionnaire and I'll build a personalized recommendation just for you."])

@endsection
