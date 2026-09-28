New AI consultation request | {{ $siteName }}

A new AI & automation consultation request was submitted and saved in your Admin Inbox.

Name: {{ $contactMessage->name }}
Email: {{ $contactMessage->email }}
Phone / WhatsApp: {{ $contactMessage->phone ?: 'Not provided' }}
Company: {{ $contactMessage->company ?: 'Not provided' }}
Website: {{ $contactMessage->website_url ?: 'Not provided' }}
Role: {{ $contactMessage->displayRole() ?: 'Not provided' }}
Decision maker: {{ $contactMessage->decision_maker ?: 'Not provided' }}
Country: {{ $contactMessage->displayCountry() ?: 'Not provided' }}
Industry: {{ $contactMessage->displayIndustry() ?: 'Not provided' }}
Company size: {{ $contactMessage->company_size ?: 'Not provided' }}
Annual turnover: {{ $contactMessage->annual_turnover ?: 'Not provided' }}
Monthly leads: {{ $contactMessage->monthly_leads ?: 'Not provided' }}
Current CRM / platform: {{ $contactMessage->displayCrm() ?: 'Not provided' }}
Service interest: {{ $contactMessage->displayServiceInterest() ?: 'Not provided' }}
Main challenge: {{ $contactMessage->displayBusinessChallenge() ?: 'Not provided' }}
Preferred contact method: {{ $contactMessage->preferred_contact_method ?: 'Not provided' }}
Time zone: {{ $contactMessage->displayTimeZone() ?: 'Not provided' }}
Project timeline: {{ $contactMessage->project_timeline ?: 'Not provided' }}

What they want to automate:
{{ $contactMessage->message ?: 'Not provided' }}

Open in Admin Inbox: {{ route('admin.messages.show', $contactMessage) }}
