<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Models\Country;
use App\Jobs\OpenVoting;
use Illuminate\Http\RedirectResponse;

class OpenVotingController extends Controller
{
    public function __invoke(Country $country): RedirectResponse
    {
        $country->openVoting();

        $voters = Voter::confirmed()->get();

        $voters->each(function (Voter $voter) use ($country) {
            OpenVoting::dispatch($country, $voter);
        });

        return redirect()->route('account.countries.show', $country)->with('status', 'Voting opened!');
    }
}
