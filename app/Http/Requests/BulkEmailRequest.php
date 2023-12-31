<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'emails' => 'required|array|min:1',
            'emails.*.recipient' => 'required|email|max:255',
            'emails.*.subject' => 'required|max:255',
            'emails.*.body' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'emails.required' => "At-least one email is required",

            'emails.*.recipient.required' => 'Email is required',
            'emails.*.recipient.email' => 'Email is not a valid email address',
            'emails.*.recipient.max' => 'Email must be 255 characters long',

            'emails.*.subject.required' => 'Subject is required',
            'emails.*.subject.max' => 'Subject must be 255 characters long',

            'emails.*.body.required' => 'Body is required',
        ];
    }

}
