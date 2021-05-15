<x-app-layout title="Voters">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit {{ $voter->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form action="{{ route('account.voters.update', $voter) }}" method="POST">
                @method('PATCH')
                @csrf

                <div>
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $voter->name)" required autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="number" :value="__('Telephone Number')" />
                    <x-input id="number" class="block mt-1 w-full" type="tel" name="number" :value="old('number', $voter->number)" required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        {{ __('Update Voter') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
