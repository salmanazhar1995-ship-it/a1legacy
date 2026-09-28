<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportIndustriesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        return [
            'import_file' => ['required', 'file', 'extensions:csv'],
        ];
    }
}
