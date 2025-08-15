<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'from' => 'required|date|bail',
            'to' => 'required|date|bail',
            'aircraft' => 'required|exists:aircrafts,id|bail',
            'task' => 'required|exists:tasks,id'
        ];
    }
}
