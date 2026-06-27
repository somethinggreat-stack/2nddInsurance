<section class="page-hero">
    <div class="container">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">/</span>
            <span>{{ $crumb ?? $heading }}</span>
        </nav>
        <h1>{{ $heading }}</h1>
        @isset($sub)<p class="lead" style="color:#bccbea">{{ $sub }}</p>@endisset
    </div>
</section>
