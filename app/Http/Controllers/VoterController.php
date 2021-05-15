<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreVoterRequest;
use App\Http\Requests\UpdateVoterRequest;

class VoterController extends Controller
{
    public function index(): View
    {
        return view('voters.index', [
            'voters' => Voter::all(),
        ]);
    }

    public function create(): View
    {
        return view('voters.create');
    }

    public function store(StoreVoterRequest $request): RedirectResponse
    {
        $voter = $request->store();

        return redirect()->route('account.voters.show', $voter)->with('status', 'Voter added successfully.');
    }

    public function show(Voter $voter): View
    {
        return view('voters.show', [
            'voter' => $voter,
        ]);
    }

    public function edit(Voter $voter): View
    {
        return view('voters.edit', [
            'voter' => $voter,
        ]);
    }

    public function update(UpdateVoterRequest $request, Voter $voter): RedirectResponse
    {
        $request->update($voter);

        return redirect()->route('account.voters.show', $voter)->with('status', 'Voter updated successfully.');
    }

    public function destroy(Voter $voter): RedirectResponse
    {
        $voter->delete();

        return redirect()->route('account.voters.index')->with('status', 'Voter deleted successfully.');
    }
}
