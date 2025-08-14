<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'from' => 'required|date',
            'to' => 'required|date',
            'aircraft' => 'required|exists:aircrafts',
            'task' => 'required|exists:tasks'
        ];
    }
}
