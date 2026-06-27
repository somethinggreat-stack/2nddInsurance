@php $site = config('site'); @endphp
<div class="trustbar">
    <div class="container">
        <div class="agent-badge"><img src="{{ asset('images/logo.png') }}" alt="Farmers Insurance" style="height:30px"><span class="lbl">Authorized Agent</span></div>
        <div class="ti"><x-icon name="badge" /> {{ $site['license'] }}</div>
        <div class="ti"><x-icon name="pin" /> Proudly Serving Michigan</div>
        <div class="ti"><x-icon name="star" style="color:#f5a623" /> 4.9 Average Rating</div>
        <div class="ti"><x-icon name="user" /> One Dedicated Local Agent</div>
    </div>
</div>
