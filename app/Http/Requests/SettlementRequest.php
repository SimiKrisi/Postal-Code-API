<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettlementRequest extends FormRequest
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
    public function rules(): array
    {
        if ($this->isMethod('patch')) {
            return [
                'code' => 'nullable|digits:4',
                'name' => 'nullable|string|max:255',
                'county_id' => 'nullable|exists:counties,id',
            ];
        }
        return [
            'code' => 'required|digits:4',
            'name' => 'required|string|max:255',
            'county_id' => 'nullable|exists:counties,id',
        ];
    }
}
