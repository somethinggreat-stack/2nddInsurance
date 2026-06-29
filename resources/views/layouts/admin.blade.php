<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') — {{ config('site.brand') }}</title>
    <link rel="icon" href="{{ asset('images/personallogo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body{background:var(--slate-50)}
        .admin-top{background:var(--grad-navy-deep);color:#fff;padding:.9rem 0}
        .admin-top .container{display:flex;align-items:center;justify-content:space-between;gap:1rem}
        .admin-top .brand__name{color:#fff}
        .admin-wrap{padding-block:2rem}
        .table-card{background:#fff;border:1px solid var(--slate-100);border-radius:var(--r-lg);box-shadow:var(--sh-sm);overflow:hidden}
        table.leads{width:100%;border-collapse:collapse;font-size:.92rem}
        table.leads th{text-align:left;padding:.85rem 1rem;background:var(--slate-50);color:var(--slate-500);font-family:var(--font-display);font-size:.78rem;letter-spacing:.05em;text-transform:uppercase;border-bottom:1px solid var(--slate-100)}
        table.leads td{padding:.85rem 1rem;border-bottom:1px solid var(--slate-100);vertical-align:middle}
        table.leads tr:hover td{background:var(--slate-50)}
        .tag{display:inline-block;padding:.25rem .6rem;border-radius:999px;font-size:.74rem;font-weight:700;font-family:var(--font-display)}
        .tag-new{background:rgba(187,10,30,.1);color:var(--red)}
        .tag-contacted{background:rgba(2,79,157,.1);color:var(--blue)}
        .tag-quoted{background:#fff4e0;color:#b8770a}
        .tag-won{background:#e3f7ea;color:#157a3e}
        .tag-closed{background:var(--slate-100);color:var(--slate-500)}
        .tag-type{background:var(--slate-100);color:var(--navy)}
        .admin-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.6rem}
        .admin-stat{background:#fff;border:1px solid var(--slate-100);border-radius:var(--r);padding:1.2rem 1.4rem;box-shadow:var(--sh-xs)}
        .admin-stat b{font-family:var(--font-display);font-size:1.9rem;color:var(--navy);display:block;line-height:1}
        .admin-stat span{color:var(--slate-500);font-size:.85rem;font-weight:600}
        .admin-toolbar{display:flex;gap:.6rem;flex-wrap:wrap;align-items:center;margin-bottom:1rem}
        .admin-toolbar select,.admin-toolbar input{padding:.6rem .9rem;border:1.5px solid var(--slate-200);border-radius:10px;background:#fff}
        @media(max-width:720px){.admin-stats{grid-template-columns:1fr 1fr}table.leads .hide-sm{display:none}}
    </style>
</head>
<body>
    <div class="admin-top">
        <div class="container">
            <a href="{{ route('admin.leads') }}" class="brand" style="gap:.9rem">
                <img src="{{ asset('images/personallogo-white.png') }}" alt="{{ config('site.agent') }}" style="height:34px;width:auto">
                <span class="brand__name" style="font-family:var(--font-display);font-weight:800;color:#fff;border-left:1px solid rgba(255,255,255,.25);padding-left:.9rem">Lead Dashboard</span>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">@csrf
                <button class="btn btn--ghost btn--sm" style="color:#fff;box-shadow:inset 0 0 0 2px rgba(255,255,255,.25)"><x-icon name="logout" /> Sign Out</button>
            </form>
        </div>
    </div>
    <div class="admin-wrap">
        <div class="container">
            @if (session('ok'))<div class="alert alert--ok"><x-icon name="check-circle" /> <span>{{ session('ok') }}</span></div>@endif
            @yield('content')
        </div>
    </div>
</body>
</html>
