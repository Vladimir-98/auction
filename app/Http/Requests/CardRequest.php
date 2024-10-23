<?php

namespace App\Http\Requests;

use App\Http\Responses\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class CardRequest extends FormRequest
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
            'crm_id' => ['required', 'integer'],
            'crm_url' => ['required', 'string'],
            'name' => ['required', 'string'],
            'desc' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'budget_min' => ['nullable', 'integer'],
            'budget_max' => ['nullable', 'integer'],
            'lead_price' => ['required', 'integer'],
            'card_status' => ['required', 'string'],
            'cities' => ['required', 'array'],
            'cities.*' => ['string', 'max:100'],
            'districts' => ['nullable', 'array'],
            'districts.*' => ['string', 'max:100'],
            'types' => ['nullable', 'array'],
            'types.*' => ['string', 'max:100'],
            'paymentTypes' => ['nullable', 'array'],
            'paymentTypes.*' => ['string', 'max:100'],
            'callRecords' => ['nullable', 'array'],
            'callRecords.*' => ['string', 'max:255'],
        ];
    }

    /**
     * @param Validator $validator
     * @return JsonResponse
     */
    protected function failedValidation(Validator $validator): JsonResponse
    {
        return ApiResponse::error($validator->errors()->first(), $validator->errors(), 422);
    }
}
