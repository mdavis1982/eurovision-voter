<?php

namespace App\Http\Requests;

use App\Models\Voter;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVoterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'number' => ['required', 'string'],
        ];
    }

    public function update(Voter $voter): bool
    {
        return $voter->update([
            'name' => $this->name,
            'number' => $this->number,
        ]);
    }
}
