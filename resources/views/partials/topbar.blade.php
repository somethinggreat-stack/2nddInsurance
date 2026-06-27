@php $site = config('site'); @endphp
<div class="topbar">
    <div class="container">
        <div class="tb-left">
            <span class="pill"><x-icon name="pin" /> {{ $site['address'] }}, {{ $site['city'] }}, {{ $site['state'] }}</span>
            <span class="pill hide-sm"><x-icon name="badge" /> {{ $site['license'] }}</span>
        </div>
        <div class="tb-right">
            <a href="mailto:{{ $site['email'] }}" class="pill hide-sm"><x-icon name="mail" /> {{ $site['email'] }}</a>
            <a href="tel:{{ $site['phone_raw'] }}" class="pill"><x-icon name="phone" /> {{ $site['phone'] }}</a>
        </div>
    </div>
</div>
