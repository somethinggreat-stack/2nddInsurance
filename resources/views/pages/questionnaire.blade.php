@extends('layouts.app')
@php $site = config('site'); @endphp
@section('title', 'Insurance Questionnaire')
@section('description', 'Answer a few quick questions and Patrick Yasso will build a personalized insurance recommendation for you. Free and no obligation.')

@section('content')

<section class="page-hero" style="padding-block:clamp(40px,6vw,64px)">
    <div class="container">
        <nav class="breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>Questionnaire</span></nav>
        <h1 style="font-size:clamp(1.9rem,4vw,2.8rem)">Your Personalized Insurance Profile</h1>
        <p class="lead" style="color:#bccbea">Takes about 2 minutes. The more you share, the more tailored your recommendation — and your savings.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        @if ($errors->any())
            <div class="quiz" style="margin-bottom:1.4rem">@include('partials.alerts')</div>
        @endif
        @include('partials.questionnaire-form')
    </div>
</section>

@endsection
