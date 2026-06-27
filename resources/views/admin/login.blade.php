<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Login — {{ config('site.brand') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body style="background:var(--grad-navy-deep);min-height:100vh;display:grid;place-items:center;padding:1.2rem">
    <div class="form-card" style="max-width:400px;width:100%">
        <div style="text-align:center;margin-bottom:1.4rem">
            <img src="{{ asset('images/logo.png') }}" alt="logo" style="height:46px;width:auto;margin-bottom:.8rem">
            <h1 style="font-size:1.5rem">Lead Dashboard</h1>
            <p style="font-size:.9rem">Enter your password to continue.</p>
        </div>
        @if ($errors->any())<div class="alert alert--err"><x-icon name="x" /> <span>{{ $errors->first() }}</span></div>@endif
        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" autofocus required>
            </div>
            <button type="submit" class="btn btn--primary btn--block btn--lg"><x-icon name="lock" /> Sign In</button>
        </form>
        <p style="text-align:center;margin-top:1rem"><a href="{{ route('home') }}" style="color:var(--slate-500);font-size:.85rem">← Back to website</a></p>
    </div>
</body>
</html>
