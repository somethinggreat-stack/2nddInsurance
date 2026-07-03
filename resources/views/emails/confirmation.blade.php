@php $site = config('site'); $first = \Illuminate\Support\Str::of($lead->name)->before(' '); @endphp
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width"></head>
<body style="margin:0;background:#f6f8fc;font-family:Arial,Helvetica,sans-serif;color:#131a2e">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f6f8fc;padding:24px 0">
        <tr><td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 10px 30px rgba(2,31,87,.1)">
                <tr><td style="background:#021F57;padding:28px 28px 24px;text-align:center">
                    <div style="color:#fff;font-size:21px;font-weight:bold;line-height:1.35">{{ $site['brand'] }}<br>will be contacting you</div>
                    <div style="color:#9fb1d8;font-size:14px;margin-top:8px">Your request has been received — thank you!</div>
                </td></tr>
                <tr><td style="height:5px;background:#BB0A1E"></td></tr>

                <tr><td style="padding:28px 28px 8px">
                    <p style="font-size:15px;line-height:1.7;margin:0 0 14px">Hi {{ $first }},</p>
                    <p style="font-size:15px;line-height:1.7;margin:0 0 14px">
                        Thank you for reaching out! We've received your information, and <strong>the {{ $site['brand'] }} team
                        will be contacting you shortly</strong> — usually the same business day — with your personalized coverage options.
                    </p>
                    <p style="font-size:15px;line-height:1.7;margin:0 0 20px">Proudly sponsored by Farmers Insurance and serving families &amp; businesses across all of Michigan.</p>
                </td></tr>

                {{-- Patrick Yasso — Farmers Insurance business card --}}
                <tr><td align="center" style="padding:6px 20px 14px">
                    <img src="{{ url('/images/business-card.png') }}"
                         alt="{{ $site['agent'] }} — {{ $site['company'] }} Agent · {{ $site['phone'] }} · {{ $site['email'] }} · {{ $site['address'] }}, {{ $site['city'] }}, {{ $site['state'] }} {{ $site['zip'] }}"
                         style="width:100%;max-width:520px;height:auto;border-radius:10px;border:1px solid #e6ebf5;display:block">
                </td></tr>

                {{-- Action buttons --}}
                <tr><td align="center" style="padding:18px 28px 6px">
                    <a href="tel:{{ $site['phone_raw'] }}" style="background:#BB0A1E;color:#fff;text-decoration:none;padding:13px 24px;border-radius:999px;font-weight:bold;display:inline-block;margin:0 5px 10px">📞 Call {{ $site['phone'] }}</a>
                    <a href="sms:{{ $site['phone_raw'] }}" style="background:#024F9D;color:#fff;text-decoration:none;padding:13px 24px;border-radius:999px;font-weight:bold;display:inline-block;margin:0 5px 10px">💬 Text Me</a>
                    <a href="{{ url('/') }}" style="background:#021F57;color:#fff;text-decoration:none;padding:13px 24px;border-radius:999px;font-weight:bold;display:inline-block;margin:0 5px 10px">🌐 Visit Website</a>
                </td></tr>

                <tr><td style="padding:14px 28px 28px">
                    <p style="font-size:15px;line-height:1.7;margin:18px 0 2px">Thank You,</p>
                    <p style="font-size:15px;line-height:1.5;margin:0;font-weight:bold">The {{ $site['brand'] }} Team</p>
                    <p style="font-size:13px;color:#697490;margin:2px 0 0">{{ $site['license'] }}</p>
                </td></tr>

                <tr><td style="padding:16px 28px;background:#f6f8fc;color:#97a0b8;font-size:12px;text-align:center;line-height:1.6">
                    {{ $site['address'] }}, {{ $site['city'] }}, {{ $site['state'] }} {{ $site['zip'] }}<br>
                    <a href="tel:{{ $site['phone_raw'] }}" style="color:#697490;text-decoration:none">{{ $site['phone'] }}</a> ·
                    <a href="mailto:{{ $site['email'] }}" style="color:#697490;text-decoration:none">{{ $site['email'] }}</a>
                </td></tr>
            </table>
            <div style="color:#97a0b8;font-size:11px;margin-top:14px;max-width:600px;padding:0 20px">This is an automated confirmation that your request was received. Coverage is not bound until a policy is issued by Farmers Insurance.</div>
        </td></tr>
    </table>
</body>
</html>
