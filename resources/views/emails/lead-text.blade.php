@php $site = config('site'); @endphp
NEW LEAD - {{ $lead->type_label }}
{{ $lead->created_at->format('l, M j, Y \a\t g:i A') }}
==============================================

CONTACT
-------
Name:  {{ $lead->name }}
Email: {{ $lead->email ?: '-' }}
Phone: {{ $lead->phone ?: '-' }}
@php $cityzip = trim(($lead->city ?? '') . ' ' . ($lead->zip ?? '')); @endphp
@if ($cityzip)
City/ZIP: {{ $cityzip }}
@endif
@if (is_array($lead->interests) && count($lead->interests))
Interested In: {{ implode(', ', $lead->interests) }}
@endif

DETAILS
-------
@if (is_array($lead->data) && count(array_filter($lead->data)))
@foreach (array_filter($lead->data) as $k => $v)
@continue(\Illuminate\Support\Str::startsWith($k, '_'))
{{ $k }}: {{ is_array($v) ? implode(', ', $v) : $v }}
@endforeach
@else
(no additional details provided)
@endif
@if ($lead->message)

MESSAGE
-------
{{ $lead->message }}
@endif

==============================================
Reply to this email to respond directly to {{ \Illuminate\Support\Str::of($lead->name)->before(' ') }}.
View all leads: {{ url('/admin/login') }}

Source: {{ $lead->source ?? 'website' }} | IP: {{ $lead->ip_address }}
