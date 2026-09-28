<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use App\Services\ContactMessageMailer;
use Illuminate\Http\RedirectResponse;

class ContactMessageController extends Controller
{
    public function __invoke(StoreContactMessageRequest $request, ContactMessageMailer $contactMessageMailer): RedirectResponse
    {
        $data = $request->validated();
        unset($data['website_check']);
        $data['name'] = trim($data['first_name'].' '.$data['last_name']);
        // The legacy contact_messages.message column is NOT NULL. The consultation
        // textarea is optional, so persist an empty string when the client leaves it blank.
        $data['message'] = trim((string) ($data['message'] ?? ''));
        $data['contact_consent'] = true;

        $contactMessage = ContactMessage::query()->create($data);
        $emailSent = $contactMessageMailer->send($contactMessage);

        return back()->with('success', $emailSent
            ? 'Thank you — your consultation request has been received. A confirmation has been sent to your email.'
            : 'Thank you — your consultation request has been received. Our team will contact you soon.');
    }
}
