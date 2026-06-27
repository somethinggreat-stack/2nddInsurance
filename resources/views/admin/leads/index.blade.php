@extends('layouts.admin')
@section('title', 'Leads')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap;margin-bottom:1.4rem">
        <h1 style="font-size:1.7rem">Leads</h1>
        <a href="{{ route('admin.leads.export') }}" class="btn btn--navy btn--sm"><x-icon name="download" /> Export CSV</a>
    </div>

    <div class="admin-stats">
        <div class="admin-stat"><b>{{ $stats['total'] }}</b><span>Total Leads</span></div>
        <div class="admin-stat"><b style="color:var(--red)">{{ $stats['new'] }}</b><span>New / Unactioned</span></div>
        <div class="admin-stat"><b>{{ $stats['today'] }}</b><span>Today</span></div>
        <div class="admin-stat"><b>{{ $stats['this_week'] }}</b><span>Last 7 Days</span></div>
    </div>

    <form method="GET" class="admin-toolbar">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search name, email, phone…">
        <select name="type" onchange="this.form.submit()">
            <option value="">All Types</option>
            @foreach (\App\Models\Lead::TYPES as $k => $v)
                <option value="{{ $k }}" @selected(request('type') === $k)>{{ $v }}</option>
            @endforeach
        </select>
        <select name="status" onchange="this.form.submit()">
            <option value="">All Statuses</option>
            @foreach (\App\Models\Lead::STATUSES as $s)
                <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <button class="btn btn--primary btn--sm"><x-icon name="search" /> Filter</button>
        @if (request()->hasAny(['q','type','status']))
            <a href="{{ route('admin.leads') }}" class="btn btn--ghost btn--sm">Reset</a>
        @endif
    </form>

    <div class="table-card">
        <table class="leads">
            <thead>
                <tr><th>Name</th><th class="hide-sm">Type</th><th class="hide-sm">Contact</th><th>Status</th><th class="hide-sm">Received</th><th></th></tr>
            </thead>
            <tbody>
                @forelse ($leads as $lead)
                    <tr>
                        <td>
                            <strong style="color:var(--navy)">{{ $lead->name }}</strong>
                            @if ($lead->city)<div style="font-size:.8rem;color:var(--slate-500)">{{ $lead->city }}</div>@endif
                        </td>
                        <td class="hide-sm"><span class="tag tag-type">{{ $lead->type_label }}</span></td>
                        <td class="hide-sm" style="font-size:.86rem">
                            @if ($lead->phone)<div><a href="tel:{{ $lead->phone }}">{{ $lead->phone }}</a></div>@endif
                            @if ($lead->email)<div style="color:var(--slate-500)">{{ $lead->email }}</div>@endif
                        </td>
                        <td><span class="tag tag-{{ $lead->status }}">{{ ucfirst($lead->status) }}</span></td>
                        <td class="hide-sm" style="font-size:.84rem;color:var(--slate-500)">{{ $lead->created_at->diffForHumans() }}</td>
                        <td><a href="{{ route('admin.leads.show', $lead) }}" class="btn btn--ghost btn--sm"><x-icon name="eye" /> View</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;padding:3rem;color:var(--slate-500)">No leads yet. They'll appear here as soon as visitors submit a form.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:1.4rem">{{ $leads->links() }}</div>
@endsection
