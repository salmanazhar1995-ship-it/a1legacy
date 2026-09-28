@props([
    'preheader',
    'eyebrow',
    'title',
    'siteName',
])
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <title>{{ $title }}</title>
    <style>
        @media only screen and (max-width: 640px) {
            .email-shell { padding: 20px 12px !important; }
            .email-card { border-radius: 18px !important; }
            .email-header, .email-body, .email-footer { padding-left: 24px !important; padding-right: 24px !important; }
            .detail-label, .detail-value { display: block !important; width: 100% !important; }
            .detail-value { padding-top: 5px !important; text-align: left !important; }
        }
    </style>
</head>
<body style="margin:0; padding:0; background:#eef3f9; color:#17233c; font-family:Inter,Segoe UI,Arial,sans-serif; -webkit-font-smoothing:antialiased;">
    <div style="display:none; max-height:0; overflow:hidden; opacity:0; color:transparent;">{{ $preheader }}</div>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%; background:#eef3f9;">
        <tr>
            <td class="email-shell" align="center" style="padding:40px 16px;">
                <table class="email-card" role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%; max-width:640px; overflow:hidden; background:#ffffff; border:1px solid #dce5f0; border-radius:24px; box-shadow:0 16px 44px rgba(18,42,76,.10);">
                    <tr>
                        <td style="height:5px; background:linear-gradient(90deg,#1877f2 0%,#53b7ff 52%,#d6a640 100%);"></td>
                    </tr>
                    <tr>
                        <td class="email-header" style="padding:28px 40px; background:#071525;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td width="46" valign="middle">
                                        <div style="width:42px; height:42px; line-height:42px; border-radius:13px; background:linear-gradient(135deg,#1477ff,#6ed5ff); color:#ffffff; font-size:15px; font-weight:800; text-align:center; letter-spacing:-.5px;">A1</div>
                                    </td>
                                    <td valign="middle" style="padding-left:12px; color:#ffffff; font-size:17px; font-weight:700; letter-spacing:.2px;">{{ $siteName }}</td>
                                    <td align="right" valign="middle" style="color:#8293aa; font-size:11px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;">Website contact</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="email-body" style="padding:42px 40px 36px;">
                            <p style="margin:0 0 10px; color:#1877f2; font-size:11px; font-weight:800; letter-spacing:1.8px; text-transform:uppercase;">{{ $eyebrow }}</p>
                            <h1 style="margin:0; color:#12213a; font-size:30px; line-height:1.25; font-weight:750; letter-spacing:-.8px;">{{ $title }}</h1>
                            <div style="margin-top:28px; color:#52627a; font-size:15px; line-height:1.75;">
                                {{ $slot }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="email-footer" style="padding:24px 40px 30px; border-top:1px solid #e8eef5; background:#f9fbfd; color:#8491a4; font-size:12px; line-height:1.6; text-align:center;">
                            This email was sent by {{ $siteName }}.<br>
                            <a href="{{ url('/') }}" style="color:#1877f2; text-decoration:none;">{{ parse_url(url('/'), PHP_URL_HOST) }}</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
