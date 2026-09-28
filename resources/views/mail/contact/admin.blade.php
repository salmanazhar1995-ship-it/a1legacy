<x-email-layout
    :site-name="$siteName"
    eyebrow="New consultation request"
    :title="'AI & automation request from '.$contactMessage->name"
    :preheader="'New consultation request from '.$contactMessage->name"
>
    <p style="margin:0 0 24px;">A new AI & automation consultation request was submitted. The complete request is saved in your Admin Inbox.</p>

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%; border:1px solid #e1e8f1; border-radius:14px; border-collapse:separate; overflow:hidden; background:#f8fafc;">
        @foreach([
            'Name' => $contactMessage->name,
            'Email' => $contactMessage->email,
            'Phone / WhatsApp' => $contactMessage->phone,
            'Company' => $contactMessage->company,
            'Website' => $contactMessage->website_url,
            'Role' => $contactMessage->displayRole(),
            'Country' => $contactMessage->displayCountry(),
            'Industry' => $contactMessage->displayIndustry(),
            'Company size' => $contactMessage->company_size,
            'Annual turnover' => $contactMessage->annual_turnover,
            'Monthly leads' => $contactMessage->monthly_leads,
            'Current CRM / platform' => $contactMessage->displayCrm(),
            'Service interest' => $contactMessage->displayServiceInterest(),
            'Main challenge' => $contactMessage->displayBusinessChallenge(),
            'Preferred contact' => $contactMessage->preferred_contact_method,
            'Time zone' => $contactMessage->displayTimeZone(),
            'Project timeline' => $contactMessage->project_timeline,
        ] as $label => $value)
            <tr>
                <td width="34%" style="padding:12px 18px; border-bottom:1px solid #e5ebf3; color:#8491a4; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.7px;">{{ $label }}</td>
                <td style="padding:12px 18px; border-bottom:1px solid #e5ebf3; color:#17233c; font-size:13px; text-align:right;">{{ $value ?: 'Not provided' }}</td>
            </tr>
        @endforeach
    </table>

    @if($contactMessage->message)
        <div style="margin-top:24px; padding:20px; border-left:4px solid #1877f2; border-radius:4px 12px 12px 4px; background:#f2f7fd;">
            <p style="margin:0 0 8px; color:#8491a4; font-size:11px; font-weight:800; letter-spacing:1.2px; text-transform:uppercase;">What they want to automate</p>
            <p style="margin:0; color:#34445d; white-space:pre-line;">{{ $contactMessage->message }}</p>
        </div>
    @endif

    <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin-top:30px;"><tr><td style="border-radius:10px; background:#1877f2;"><a href="{{ route('admin.messages.show', $contactMessage) }}" style="display:inline-block; padding:13px 22px; color:#ffffff; font-size:14px; font-weight:700; text-decoration:none;">Open consultation in Admin →</a></td></tr></table>
    <p style="margin:20px 0 0; color:#8491a4; font-size:12px;">Reply directly to this email to respond to {{ $contactMessage->name }}.</p>
</x-email-layout>
