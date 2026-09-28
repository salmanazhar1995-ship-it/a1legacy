Consultation request received | {{ $siteName }}

Hello {{ $contactMessage->name }},

Thank you for contacting {{ $siteName }}. We received your AI & automation consultation request and will review your business, current systems and priorities before following up.

Industry: {{ $contactMessage->displayIndustry() ?: 'Not provided' }}
Interest: {{ $contactMessage->displayServiceInterest() ?: 'Not provided' }}
Timeline: {{ $contactMessage->project_timeline ?: 'Not provided' }}

We will reply using your preferred contact method where possible.

Warm regards,
The {{ $siteName }} team
