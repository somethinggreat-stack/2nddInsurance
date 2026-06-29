@php $site = config('site'); @endphp
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width"></head>
<body style="margin:0;background:#f6f8fc;font-family:Arial,Helvetica,sans-serif;color:#131a2e">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f6f8fc;padding:24px 0">
        <tr><td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 10px 30px rgba(2,31,87,.1)">
                <tr><td style="background:#021F57;padding:24px 28px">
                    <div style="color:#fff;font-size:20px;font-weight:bold">New {{ $lead->type_label }}</div>
                    <div style="color:#9fb1d8;font-size:13px;margin-top:4px">{{ $lead->created_at->format('M j, Y · g:i A') }} — {{ $site['brand'] }}</div>
                </td></tr>
                <tr><td style="height:5px;background:#BB0A1E"></td></tr>
                <tr><td style="padding:28px">
                    <table width="100%" cellpadding="0" cellspacing="0" style="font-size:15px">
                        @php
                            $rows = array_filter([
                                'Name' => $lead->name,
                                'Email' => $lead->email,
                                'Phone' => $lead->phone,
                                'City / ZIP' => trim(($lead->city ?? '') . ' ' . ($lead->zip ?? '')),
                                'Interested In' => is_array($lead->interests) ? implode(', ', $lead->interests) : null,
                            ]);
                        @endphp
                        @foreach ($rows as $k => $v)
                            <tr>
                                <td style="padding:9px 0;color:#697490;width:140px;vertical-align:top;border-bottom:1px solid #eef1f7">{{ $k }}</td>
                                <td style="padding:9px 0;font-weight:bold;color:#131a2e;border-bottom:1px solid #eef1f7">{{ $v }}</td>
                            </tr>
                        @endforeach
                        @if (is_array($lead->data))
                            @foreach (array_filter($lead->data) as $k => $v)
                                <tr>
                                    <td style="padding:9px 0;color:#697490;vertical-align:top;border-bottom:1px solid #eef1f7">{{ $k }}</td>
                                    <td style="padding:9px 0;font-weight:bold;color:#131a2e;border-bottom:1px solid #eef1f7">{{ is_array($v) ? implode(', ', $v) : $v }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                    @if ($lead->message)
                        <div style="margin-top:18px;background:#f6f8fc;border-radius:10px;padding:16px">
                            <div style="color:#697490;font-size:13px;margin-bottom:6px">Message</div>
                            <div style="white-space:pre-wrap">{{ $lead->message }}</div>
                        </div>
                    @endif
                    <div style="margin-top:24px">
                        @if ($lead->phone)
                            <a href="tel:{{ $lead->phone }}" style="background:#BB0A1E;color:#fff;text-decoration:none;padding:12px 20px;border-radius:999px;font-weight:bold;display:inline-block;margin:0 6px 8px 0">Call {{ \Illuminate\Support\Str::of($lead->name)->before(' ') }}</a>
                        @endif
                        @if ($lead->email)
                            <a href="mailto:{{ $lead->email }}" style="background:#024F9D;color:#fff;text-decoration:none;padding:12px 20px;border-radius:999px;font-weight:bold;display:inline-block;margin:0 6px 8px 0">Email</a>
                        @endif
                        <a href="{{ url('/admin/login') }}" style="background:#021F57;color:#fff;text-decoration:none;padding:12px 20px;border-radius:999px;font-weight:bold;display:inline-block;margin:0 6px 8px 0">Open Dashboard</a>
                    </div>
                </td></tr>
                <tr><td style="padding:16px 28px;background:#f6f8fc;color:#97a0b8;font-size:12px">
                    Source: {{ $lead->source ?? 'website' }} · IP: {{ $lead->ip_address }}
                </td></tr>
            </table>
        </td></tr>
    </table>
</body>
</html>
