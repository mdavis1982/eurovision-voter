<x-app-layout title="Countries">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex flex-col space-y-1">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-flex space-x-2">
                    <span>{{ $country->flag }}</span>
                    <span>{{ $country->name }}</span>
                </h2>
                <div class="text-sm text-gray-600">
                    <span class="font-bold">"{{ $country->song_title }}"</span> by <span class="font-bold">{{ $country->artist }}</span>
                </div>
            </div>

            <div class="flex items-center space-x-2">
                <x-link-button :href="route('account.countries.edit', $country)">Edit</x-link-button>
                <form action="{{ route('account.countries.destroy', $country) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <x-button>Delete</x-button>
                </form>
                @if ($country->isNotCurrentlyVoting())
                    <form action="{{ route('account.countries.announce', $country) }}" method="POST">
                        @csrf
                        <x-button>Announce</x-button>
                    </form>

                    <form action="{{ route('account.countries.open-voting', $country) }}" method="POST">
                        @csrf
                        <x-button>Open Voting</x-button>
                    </form>
                @else
                    <form action="{{ route('account.countries.close-voting', $country) }}" method="POST">
                        @csrf
                        <x-button>Close Voting</x-button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-gray-400">Information about the country to be added.</span>
        </div>
    </div>
</x-app-layout>
