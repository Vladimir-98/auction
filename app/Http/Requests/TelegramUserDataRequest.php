<?php

namespace App\Http\Requests;

use App\Http\Responses\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TelegramUserDataRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'client.telegram_id' => ['required', 'integer'],
            'client.first_name' => ['required', 'string'],
            'client.last_name' => ['string'],
            'client.username' => ['required', 'string'],
            'client.language_code' => ['required', 'string'],
            'client.allows_write_to_pm' => ['required', 'boolean']
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        ApiResponse::error($validator->errors()->first(), $validator->errors());
    }
}
