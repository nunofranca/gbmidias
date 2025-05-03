<?php

namespace App\Http\Requests\WhatsApp;

use Illuminate\Foundation\Http\FormRequest;

class WebHookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    protected function prepareForValidation(): void
    {
        $request = $this->all()['entry'][0]['changes'][0]['value'];
        $this->merge([
            'appId' => $this->all()['entry'][0]['id'],
            'contact' => $request['contacts'][0] ?? null,
            'message' => $request['messages'][0] ?? null,
            'status' => $request['statuses'][0] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'appId' => 'nullable|string',
            'message' => 'nullable|array',
            'contact' => 'nullable|array',
            'status' => 'nullable|array',

        ];
    }
}
