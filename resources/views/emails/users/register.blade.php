<table>
    <tbody>
    <tr>
        <td style="font-family:Helvetica,Arial,sans-serif!important;font-size:16px;line-height:24px;padding-top:20px;padding-bottom:20px">
            <h3 style="margin-top:0;margin-bottom:0;font-family:'Montserrat',Helvetica,Arial,sans-serif!important;font-weight:700;font-size:20px;line-height:30px;color:#222">
                Verify your email address to complete registration
            </h3>
        </td>
    </tr>
    <tr>
        <td style="font-family:Helvetica,Arial,sans-serif!important;font-size:16px;line-height:24px;padding-top:20px">
            Hi, {{ $params['user']->name }},
        </td>
    </tr>
    <tr>
        <td style="font-family:Helvetica,Arial,sans-serif!important;font-size:16px;line-height:24px;padding-top:20px">
            Thanks for your interest in joining! To complete your registration, we need you to verify your email address.
        </td>
    </tr>
    <tr>
        <td style="font-family:Helvetica,Arial,sans-serif!important;font-size:16px;line-height:24px;padding-top:40px;padding-bottom:20px">
            <div style="max-width:300px;margin:auto;">
                <a style="background-color:#37a000;border:2px solid #37a000;border-radius:2px;color:#ffffff;white-space:nowrap;font-weight:bold;display:block;font-family:Helvetica,Arial,sans-serif;font-size:16px;line-height:36px;text-align:center;text-decoration:none"
                   href="{{ route('verify', ['token' => $params['user']->api_token]) }}"
                   target="_blank">
                    Verify Email
                </a>
            </div>
        </td>
    </tr>
    </tbody>
</table>


