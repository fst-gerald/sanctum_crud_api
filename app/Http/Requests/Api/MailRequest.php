<?php
namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'subject'   => ['required'],
            'message'   => ['required'],
            'mail_to'   => ['required', 'email'],
        ];
    }
}
