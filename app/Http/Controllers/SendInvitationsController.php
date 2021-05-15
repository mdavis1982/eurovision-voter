<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Jobs\SendInvitation;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SendInvitationsController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $voters = Voter::notConfirmed()->get();

        $voters->each(function (Voter $voter) {
            SendInvitation::dispatch($voter);
        });

        return redirect()->route('account.dashboard')->with('status', 'Invitations sent!');
    }
}
