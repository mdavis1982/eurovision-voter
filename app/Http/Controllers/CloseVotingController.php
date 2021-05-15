<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Models\Country;
use App\Jobs\CloseVoting;
use Illuminate\Http\RedirectResponse;

class CloseVotingController extends Controller
{
    public function __invoke(Country $country): RedirectResponse
    {
        $voters = Voter::confirmed()->get();

        $country->closeVoting();

        $voters->each(function (Voter $voter) use ($country) {
            CloseVoting::dispatch($country, $voter);
        });

        return redirect()->route('account.countries.show', $country)->with('status', 'Voting closed!');
    }
}
