<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Profiel bewerken: {{ $user->name }}</h2></x-slot>

  <div class="py-6 max-w-3xl mx-auto">
    <div class="bg-white p-6 rounded-lg shadow">
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')
            <!-- velden -->
            <x-primary-button>Opslaan</x-primary-button>
        </form>

    </div>
  </div>
</x-app-layout>
