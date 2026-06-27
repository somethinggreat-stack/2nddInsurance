@extends('layouts.admin')
@section('title', 'Lead — ' . $lead->name)

@section('content')
    <a href="{{ route('admin.leads') }}" style="color:var(--slate-500);font-size:.9rem"><x-icon name="chevron-right" style="transform:rotate(180deg);display:inline;width:.9em;height:.9em" /> Back to all leads</a>

    <div class="split" style="align-items:start;margin-top:1rem;gap:1.6rem">
        <div>
            <div class="table-card" style="padding:1.6rem">
                <div style="display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap">
                    <div>
                        <h1 style="font-size:1.6rem">{{ $lead->name }}</h1>
                        <span class="tag tag-type">{{ $lead->type_label }}</span>
                        <span class="tag tag-{{ $lead->status }}">{{ ucfirst($lead->status) }}</span>
                    </div>
                    <div style="font-size:.85rem;color:var(--slate-500)">{{ $lead->created_at->format('M j, Y · g:i A') }}</div>
                </div>

                <div class="divider" style="margin:1.3rem 0"></div>

                <table style="width:100%;border-collapse:collapse;font-size:.95rem">
                    @php
                        $rows = array_filter([
                            'Email' => $lead->email,
                            'Phone' => $lead->phone,
                            'City' => $lead->city,
                            'ZIP' => $lead->zip,
                            'Interested In' => is_array($lead->interests) ? implode(', ', $lead->interests) : null,
                        ]);
                    @endphp
                    @foreach ($rows as $k => $v)
                        <tr><td style="padding:.6rem 0;color:var(--slate-500);width:160px;vertical-align:top">{{ $k }}</td><td style="padding:.6rem 0;font-weight:600;color:var(--navy)">{{ $v }}</td></tr>
                    @endforeach
                    @if (is_array($lead->data))
                        @foreach (array_filter($lead->data) as $k => $v)
                            <tr><td style="padding:.6rem 0;color:var(--slate-500);vertical-align:top">{{ $k }}</td><td style="padding:.6rem 0;font-weight:600;color:var(--navy)">{{ is_array($v) ? implode(', ', $v) : $v }}</td></tr>
                        @endforeach
                    @endif
                </table>

                @if ($lead->message)
                    <div style="margin-top:1.2rem;background:var(--slate-50);border-radius:10px;padding:1rem">
                        <div style="color:var(--slate-500);font-size:.82rem;margin-bottom:.4rem">Message / Notes</div>
                        <div style="white-space:pre-wrap;color:var(--slate-700)">{{ $lead->message }}</div>
                    </div>
                @endif
            </div>
        </div>

        <div style="display:grid;gap:1rem">
            <div class="table-card" style="padding:1.4rem">
                <h3 style="font-size:1.05rem;margin-bottom:1rem">Quick Actions</h3>
                <div style="display:grid;gap:.6rem">
                    @if ($lead->phone)<a href="tel:{{ $lead->phone }}" class="btn btn--primary btn--block"><x-icon name="phone" /> Call</a>@endif
                    @if ($lead->phone)<a href="sms:{{ $lead->phone }}" class="btn btn--ghost btn--block"><x-icon name="chat" /> Text</a>@endif
                    @if ($lead->email)<a href="mailto:{{ $lead->email }}" class="btn btn--ghost btn--block"><x-icon name="mail" /> Email</a>@endif
                </div>
            </div>

            <div class="table-card" style="padding:1.4rem">
                <h3 style="font-size:1.05rem;margin-bottom:1rem">Update Status</h3>
                <form action="{{ route('admin.leads.update', $lead) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="field">
                        <select name="status">
                            @foreach (\App\Models\Lead::STATUSES as $s)
                                <option value="{{ $s }}" @selected($lead->status === $s)>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn--navy btn--block"><x-icon name="check" /> Save Status</button>
                </form>
                @if ($lead->contacted_at)
                    <p style="font-size:.8rem;color:var(--slate-500);margin-top:.7rem">First actioned {{ $lead->contacted_at->diffForHumans() }}</p>
                @endif
            </div>

            <form action="{{ route('admin.leads.destroy', $lead) }}" method="POST" onsubmit="return confirm('Delete this lead permanently?')">
                @csrf @method('DELETE')
                <button class="btn btn--ghost btn--block btn--sm" style="color:var(--red);box-shadow:inset 0 0 0 2px rgba(187,10,30,.2)"><x-icon name="trash" /> Delete Lead</button>
            </form>
        </div>
    </div>
@endsection
