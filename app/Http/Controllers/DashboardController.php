<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $countries = Country::query()
            ->whereHas('votes')
            ->withCount('votes')
            ->withSum('votes', 'value')
            ->orderByDesc('votes_sum_value')
            ->get()
        ;

        $activeCountry = Country::currentlyVoting()->first();

        return view('dashboard', [
            'countries' => $countries,
            'activeCountry' => $activeCountry,
        ]);
    }
}
