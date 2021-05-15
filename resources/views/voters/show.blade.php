<x-app-layout title="Voters">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex flex-col space-y-1">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $voter->name }}
                </h2>
                <div class="text-sm text-gray-600">
                    {{ $voter->number }}
                </div>
            </div>

            <div class="flex items-center space-x-2">
                <x-link-button :href="route('account.voters.edit', $voter)">Edit</x-link-button>
                <form action="{{ route('account.voters.destroy', $voter) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <x-button>Delete</x-button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-gray-400">Functionality to send a one-off message could go here.</span>
        </div>
    </div>
</x-app-layout>
