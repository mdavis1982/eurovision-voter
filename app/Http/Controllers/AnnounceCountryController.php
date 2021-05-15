<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Models\Country;
use App\Jobs\AnnounceCountry;
use Illuminate\Http\RedirectResponse;

class AnnounceCountryController extends Controller
{
    public function __invoke(Country $country): RedirectResponse
    {
        $voters = Voter::confirmed()->get();

        $voters->each(function (Voter $voter) use ($country) {
            AnnounceCountry::dispatch($country, $voter);
        });

        return redirect()->route('account.countries.show', $country)->with('status', 'Country announced!');
    }
}
