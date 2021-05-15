<x-app-layout title="Dashboard">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <form action="{{ route('account.send-invitations') }}" method="POST">
                @csrf
                <x-button>Send Invitations</x-button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($activeCountry)
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Active Country</h2>
                <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-16">
                    <a href="{{ route('account.countries.show', $activeCountry) }}" class="block hover:bg-gray-50">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col space-y-1">
                                    <p class="text-lg font-medium text-indigo-600 truncate inline-flex space-x-2">
                                        <span>{{ $activeCountry->flag }}</span>
                                        <span>{{ $activeCountry->name }}</span>
                                    </p>
                                    <p class="text-sm font-medium text-gray-600 truncate">
                                        <span class="font-bold">"{{ $activeCountry->song_title }}"</span> by <span class="font-bold">{{ $activeCountry->artist }}</span>
                                    </p>
                                </div>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Currently Voting
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Results</h2>
            @if ($countries->isNotEmpty())
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <ul class="divide-y divide-gray-200">
                        @foreach ($countries as $country)
                            <li>
                                <a href="{{ route('account.countries.show', $country) }}" class="block hover:bg-gray-50">
                                    <div class="px-4 py-4 sm:px-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex flex-col space-y-1">
                                                <p class="text-lg font-medium text-indigo-600 truncate inline-flex space-x-2">
                                                    <span>{{ $country->flag }}</span>
                                                    <span>{{ $country->name }}</span>
                                                </p>
                                                <p class="text-sm font-medium text-gray-600 truncate">
                                                    <span class="font-bold">"{{ $country->song_title }}"</span> by <span class="font-bold">{{ $country->artist }}</span>
                                                </p>
                                            </div>
                                            <div class="ml-2 flex-shrink-0 flex">
                                                <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $country->votes_sum_value }} from {{ $country->votes_count }} {{ Illuminate\Support\Str::plural('vote', $country->votes_count) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 text-center text-gray-500">
                        No votes have been cast yet.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
