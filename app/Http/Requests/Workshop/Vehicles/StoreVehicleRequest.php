<?php

namespace App\Http\Requests\Workshop\Vehicles;

use Idat\Centeno\Workshop\Enums\FuelType;
use Idat\Centeno\Workshop\Enums\TransmissionType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->hasUser();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'numeric', 'exists:customers,id'],
            'name' => ['required', 'string'],
            'body_type' => ['nullable', 'string'],
            'maker' => ['nullable', 'string'],
            'model' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
            'year' => ['nullable', 'numeric'],
            'fuel_type' => ['required', 'string', new Enum(FuelType::class)],
            'transmission_type' => ['required', 'string', new Enum(TransmissionType::class)],
            'plate' => ['nullable', 'string', 'unique:vehicles'],
            'mileage' => ['nullable', 'numeric'],
        ];
    }
}
