<x-app-layout title="Voters">
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Voters') }}
            </h2>

            <x-link-button :href="route('account.voters.create')">Add a Voter</x-link-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($voters->isNotEmpty())
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <ul class="divide-y divide-gray-200">
                        @foreach ($voters as $voter)
                            <li>
                                <a href="{{ route('account.voters.show', $voter) }}" class="block hover:bg-gray-50">
                                    <div class="px-4 py-4 sm:px-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex flex-col space-y-1">
                                                <p class="text-lg font-medium text-indigo-600 truncate">
                                                    {{ $voter->name }}
                                                </p>
                                                <p class="text-sm font-medium text-gray-600 truncate">
                                                    {{ $voter->number }}
                                                </p>
                                            </div>
                                            <div class="ml-2 flex-shrink-0 flex">
                                                <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $voter->isConfirmed() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $voter->isConfirmed() ? 'Confirmed' : 'Not Confirmed' }}
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
                        There are no voters registered.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
