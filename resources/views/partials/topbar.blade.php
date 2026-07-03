@php $site = config('site'); @endphp
<div class="topbar">
    <div class="container">
        <div class="tb-left">
            <span class="pill tb-agent">
                <img src="{{ asset('images/logo.png') }}" alt="Farmers Insurance" style="height:20px;width:auto;filter:brightness(0) invert(1);opacity:.95">
                <b style="font-weight:800;letter-spacing:.07em;text-transform:uppercase;font-size:.78rem">Authorized Agent</b>
            </span>
            <span class="pill hide-sm"><x-icon name="badge" /> {{ $site['license'] }}</span>
        </div>
        <div class="tb-right">
            <a href="mailto:{{ $site['email'] }}" class="pill hide-sm"><x-icon name="mail" /> {{ $site['email'] }}</a>
            <a href="tel:{{ $site['phone_raw'] }}" class="pill"><x-icon name="phone" /> {{ $site['phone'] }}</a>
        </div>
    </div>
</div>
