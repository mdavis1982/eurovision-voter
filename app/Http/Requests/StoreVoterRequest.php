<?php

namespace App\Http\Requests;

use App\Models\Voter;
use Illuminate\Foundation\Http\FormRequest;

class StoreVoterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'number' => ['required', 'string'],
        ];
    }

    public function store(): Voter
    {
        return Voter::create([
            'name' => $this->name,
            'number' => $this->number,
        ]);
    }
}
