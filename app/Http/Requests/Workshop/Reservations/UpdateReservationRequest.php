<?php

namespace App\Http\Requests\Workshop\Reservations;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => 'required|exists:services,id',
            'reservation_date' => 'required|date|after:now',
            'reservation_time' => 'required|date_format:H:i:s',
            'notes' => 'nullable|string',
        ];
    }
}
