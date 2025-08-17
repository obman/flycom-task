<?php

namespace App\Http\Requests;

use App\Models\User;
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

    protected function prepareForValidation(): void
    {
        // assuming user was authenticated via Auth::user()
        // for sake of simplicity and mocking user is predefined
        $this->merge([
            'user' => User::find(1)
        ]);
    }
}
