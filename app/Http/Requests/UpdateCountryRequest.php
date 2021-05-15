<?php

namespace App\Http\Requests;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'flag' => ['nullable', 'string'],
            'song_title' => ['required', 'string', 'max:255'],
            'artist' => ['required', 'string', 'max:255'],
        ];
    }

    public function update(Country $country): bool
    {
        return $country->update([
            'name' => $this->name,
            'flag' => $this->flag,
            'song_title' => $this->song_title,
            'artist' => $this->artist,
        ]);
    }
}
