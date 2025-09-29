<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Profiel bewerken</h2>
    </x-slot>

    <form method="POST" action="{{ route('users.update', $user) }}" class="p-6 space-y-4 max-w-lg">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="name" value="Naam" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          value="{{ old('name', $user->name) }}" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          value="{{ old('email', $user->email) }}" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-4">
            <x-primary-button>Opslaan</x-primary-button>
        </div>
    </form>
</x-app-layout>
