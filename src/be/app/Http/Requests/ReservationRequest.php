<?php

namespace App\Http\Requests;

use App\Models\User;
use App\DTO\ReservationDto;
use App\Enums\ReservationType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'dates' => 'required|array|min:1',
            'date.*' => 'required|date',
            'task' => 'required|exists:tasks,id',
            'aircraft' => 'required|exists:aircrafts,id',
            'mode' => ['required', Rule::enum(ReservationType::class)]
        ];
    }

    public function toDto(): ReservationDto
    {
        $data = $this->validated();

        // assuming user was authenticated via Auth::user()
        // for sake of simplicity and mocking, user is predefined
        return new ReservationDto(
            aircraftId: $data['aircraft'],
            taskId: $data['task'],
            dates: $data['dates'],
            mode: ReservationType::from($data['mode']),
            user: User::find(1)
        );
    }
}
