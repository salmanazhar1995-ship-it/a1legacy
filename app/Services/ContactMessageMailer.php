<?php

namespace App\Services;

use App\Mail\ContactEnquiryConfirmation;
use App\Mail\ContactEnquiryReceived;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Throwable;

final class ContactMessageMailer
{
    public function send(ContactMessage $contactMessage): bool
    {
        $settings = SiteSetting::query()
            ->whereIn('key', ['contact_email', 'site_name'])
            ->pluck('value', 'key');

        $siteName = trim((string) $settings->get('site_name')) ?: (string) config('app.name');
        $adminEmail = trim((string) $settings->get('contact_email'));

        if (! filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            $adminEmail = (string) config('mail.from.address');
        }

        if (filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            $this->sendSafely(
                $adminEmail,
                new ContactEnquiryReceived($contactMessage, $siteName),
            );
        }

        return $this->sendSafely(
            $contactMessage->email,
            new ContactEnquiryConfirmation($contactMessage, $siteName),
        );
    }

    private function sendSafely(string $recipient, Mailable $mailable): bool
    {
        try {
            Mail::to($recipient)->send($mailable);

            return true;
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }
    }
}
