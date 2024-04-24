<?php

namespace App\Http\Requests;

use App\Enums\PollTypeStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePollTypeRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'unique:poll_types,name', 'min:3', 'max:255'],
            'description' => ['string', 'nullable'],
            'status' => [Rule::enum(PollTypeStatus::class)],
        ];
    }
}
