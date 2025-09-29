<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Gebruikers</h2></x-slot>

  <div class="p-6 max-w-5xl mx-auto">
    <form method="GET" class="mb-4">
      <x-text-input name="q" placeholder="Zoek op naam of e-mail"
                    value="{{ $q }}" class="w-full" />
    </form>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
      @forelse ($users as $u)
        <a href="{{ route('users.show', $u) }}" class="block p-4 bg-white rounded-lg shadow hover:shadow-md">
          <div class="font-semibold">{{ $u->name }}</div>
          <div class="text-sm text-gray-600">{{ $u->email }}</div>
        </a>
      @empty
        <div class="text-gray-600">Geen gebruikers gevonden.</div>
      @endforelse
    </div>

    <div class="mt-6">{{ $users->links() }}</div>
  </div>
</x-app-layout>
