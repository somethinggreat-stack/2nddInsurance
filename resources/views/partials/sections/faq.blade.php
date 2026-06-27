@php
    $site = config('site');
    $items = isset($limit) ? array_slice($site['faqs'], 0, $limit) : $site['faqs'];
@endphp
<div class="accordion">
    @foreach ($items as $i => $f)
        <details class="acc reveal" data-delay="{{ $i % 3 }}" {{ $i === 0 ? 'open' : '' }}>
            <summary>{{ $f['q'] }} <span class="pm"><x-icon name="plus" /></span></summary>
            <div class="acc__body">{{ $f['a'] }}</div>
        </details>
    @endforeach
</div>

@push('schema')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(fn ($f) => [
        '@type' => 'Question',
        'name' => $f['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ], $items),
], JSON_UNESCAPED_SLASHES) !!}
</script>
@endpush
