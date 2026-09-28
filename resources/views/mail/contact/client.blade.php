<x-email-layout
    :site-name="$siteName"
    eyebrow="Consultation request received"
    :title="'Thanks, '.$contactMessage->name"
    preheader="We received your AI & automation consultation request."
>
    <p style="margin:0 0 18px;">Hello {{ $contactMessage->name }},</p>
    <p style="margin:0 0 24px;">Thank you for contacting {{ $siteName }}. We received your AI & automation consultation request and will review your business, current systems and priorities before following up.</p>

    <div style="padding:22px; border:1px solid #e1e8f1; border-radius:14px; background:#f8fafc;">
        <p style="margin:0 0 9px; color:#8491a4; font-size:11px; font-weight:800; letter-spacing:1.2px; text-transform:uppercase;">Request summary</p>
        <p style="margin:0 0 8px; color:#34445d;"><strong>Industry:</strong> {{ $contactMessage->displayIndustry() ?: 'Not provided' }}</p>
        <p style="margin:0 0 8px; color:#34445d;"><strong>Interest:</strong> {{ $contactMessage->displayServiceInterest() ?: 'Not provided' }}</p>
        <p style="margin:0; color:#34445d;"><strong>Timeline:</strong> {{ $contactMessage->project_timeline ?: 'Not provided' }}</p>
    </div>

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:24px; width:100%;"><tr><td style="padding:16px 18px; border-radius:12px; background:#eef6ff; color:#38506f; font-size:13px; line-height:1.6;"><strong style="color:#1877f2;">What happens next?</strong><br>A member of our team will reply using your preferred contact method where possible. We’ll use the details you submitted only to review and respond to your enquiry.</td></tr></table>

    <p style="margin:26px 0 0;">Warm regards,<br><strong style="color:#17233c;">The {{ $siteName }} team</strong></p>
</x-email-layout>
