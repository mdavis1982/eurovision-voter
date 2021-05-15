<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;

class CountryController extends Controller
{
    public function index(): View
    {
        return view('countries.index', [
            'countries' => Country::all(),
        ]);
    }

    public function create(): View
    {
        return view('countries.create');
    }

    public function store(StoreCountryRequest $request): RedirectResponse
    {
        $country = $request->store();

        return redirect()->route('account.countries.show', $country);
    }

    public function show(Country $country): View
    {
        return view('countries.show', [
            'country' => $country,
        ]);
    }

    public function edit(Country $country): View
    {
        return view('countries.edit', [
            'country' => $country,
        ]);
    }

    public function update(UpdateCountryRequest $request, Country $country): RedirectResponse
    {
        $request->update($country);

        return redirect()->route('account.countries.show', $country);
    }

    public function destroy(Country $country): RedirectResponse
    {
        $country->delete();

        return redirect()->route('account.countries.index');
    }
}
