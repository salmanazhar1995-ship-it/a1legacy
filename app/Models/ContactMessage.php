<?php

namespace App\Models;

use Database\Factories\ContactMessageFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name', 'first_name', 'last_name', 'email', 'company', 'phone', 'website_url',
    'role', 'role_other', 'decision_maker', 'country', 'country_other', 'industry', 'industry_other',
    'company_size', 'annual_turnover', 'monthly_leads', 'current_crm', 'current_crm_other',
    'service_interest', 'service_interest_other', 'business_challenge', 'business_challenge_other',
    'preferred_contact_method', 'preferred_time_zone', 'preferred_time_zone_other', 'project_timeline',
    'message', 'contact_consent', 'status', 'read_at',
])]
class ContactMessage extends Model
{
    /** @use HasFactory<ContactMessageFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'contact_consent' => 'boolean',
            'read_at' => 'datetime',
        ];
    }

    public function displayRole(): ?string
    {
        return $this->role === 'Other' ? ($this->role_other ?: $this->role) : $this->role;
    }

    public function displayCountry(): ?string
    {
        return $this->country === 'Other' ? ($this->country_other ?: $this->country) : $this->country;
    }

    public function displayIndustry(): ?string
    {
        return $this->industry === 'Other' ? ($this->industry_other ?: $this->industry) : $this->industry;
    }

    public function displayCrm(): ?string
    {
        return $this->current_crm === 'Other' ? ($this->current_crm_other ?: $this->current_crm) : $this->current_crm;
    }

    public function displayServiceInterest(): ?string
    {
        return $this->service_interest === 'Other' ? ($this->service_interest_other ?: $this->service_interest) : $this->service_interest;
    }

    public function displayBusinessChallenge(): ?string
    {
        return $this->business_challenge === 'Other' ? ($this->business_challenge_other ?: $this->business_challenge) : $this->business_challenge;
    }

    public function displayTimeZone(): ?string
    {
        return $this->preferred_time_zone === 'Other' ? ($this->preferred_time_zone_other ?: $this->preferred_time_zone) : $this->preferred_time_zone;
    }
}
