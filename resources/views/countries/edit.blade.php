<x-app-layout title="Countries">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit {{ $country->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form action="{{ route('account.countries.update', $country) }}" method="POST">
                @method('PATCH')
                @csrf

                <div>
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $country->name)" required autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="flag" :value="__('Flag')" />
                    <x-input id="flag" class="block mt-1 w-full" type="text" name="flag" :value="old('flag', $country->flag)" required autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="song_title" :value="__('Song Title')" />
                    <x-input id="song_title" class="block mt-1 w-full" type="text" name="song_title" :value="old('song_title', $country->song_title)" required autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="artist" :value="__('Artist')" />
                    <x-input id="artist" class="block mt-1 w-full" type="text" name="artist" :value="old('artist', $country->artist)" required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        {{ __('Update Country') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
