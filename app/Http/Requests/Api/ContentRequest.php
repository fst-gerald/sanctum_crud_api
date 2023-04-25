<?php
namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContentRequest extends FormRequest
{
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return $this->update();
        } else {
            return  $this->store();
        }
    }

    private function store(): array
    {
        return [
            'title'   => [
                'required',
                Rule::unique('contents', 'title')
            ],
            'details' => ['required']
        ];
    }

    private function update(): array
    {
        $content = $this->route()->parameter('content');

        return [
            'title'   => [
                'required',
                Rule::unique('contents', 'title')->ignore($content)
            ],
            'details' => ['required']
        ];
    }
}
