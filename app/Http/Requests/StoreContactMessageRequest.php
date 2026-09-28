<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:60'],
            'company' => ['required', 'string', 'max:160'],
            'website_url' => ['nullable', 'url:http,https', 'max:500'],
            'role' => ['required', 'string', 'max:160'],
            'role_other' => ['nullable', 'required_if:role,Other', 'string', 'max:160'],
            'decision_maker' => ['required', Rule::in(['Yes', 'No'])],
            'country' => ['required', 'string', 'max:120'],
            'country_other' => ['nullable', 'required_if:country,Other', 'string', 'max:120'],
            'industry' => ['required', 'string', 'max:160'],
            'industry_other' => ['nullable', 'required_if:industry,Other', 'string', 'max:160'],
            'company_size' => ['required', 'string', 'max:60'],
            'annual_turnover' => ['required', 'string', 'max:80'],
            'monthly_leads' => ['required', 'string', 'max:80'],
            'current_crm' => ['required', 'string', 'max:160'],
            'current_crm_other' => ['nullable', 'required_if:current_crm,Other', 'string', 'max:160'],
            'service_interest' => ['required', 'string', 'max:190'],
            'service_interest_other' => ['nullable', 'required_if:service_interest,Other', 'string', 'max:190'],
            'business_challenge' => ['required', 'string', 'max:190'],
            'business_challenge_other' => ['nullable', 'required_if:business_challenge,Other', 'string', 'max:190'],
            'preferred_contact_method' => ['required', Rule::in(['WhatsApp', 'Phone Call', 'Email', 'Video Call'])],
            'preferred_time_zone' => ['required', 'string', 'max:120'],
            'preferred_time_zone_other' => ['nullable', 'required_if:preferred_time_zone,Other', 'string', 'max:160'],
            'project_timeline' => ['required', 'string', 'max:80'],
            'message' => ['nullable', 'string', 'max:5000'],
            'contact_consent' => ['accepted'],
            'website_check' => ['nullable', 'max:0'],
        ];
    }
}
