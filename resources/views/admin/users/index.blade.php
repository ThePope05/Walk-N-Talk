<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gebruikersbeheer
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="get" class="mb-4 flex gap-2">
                    <input type="text" name="q" value="{{ $q }}" placeholder="Zoek op naam of e-mail"
                           class="border rounded px-3 py-2 w-full">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">Zoeken</button>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left p-3">ID</th>
                                <th class="text-left p-3">Naam</th>
                                <th class="text-left p-3">E-mail</th>
                                <th class="text-left p-3">Admin</th>
                                <th class="text-left p-3">Aangemaakt</th>
                                <th class="text-left p-3">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
        @forelse ($users as $u)
            <tr class="border-t">
                <td class="p-3">{{ $u->id }}</td>
                <td class="p-3">{{ $u->name }}</td>
                <td class="p-3">{{ $u->email }}</td>
                <td class="p-3">{{ $u->is_admin ? 'Admin' : 'User' }}</td>
                <td class="p-3">{{ $u->created_at->format('Y-m-d H:i') }}</td>
                <td class="p-3">
                    <a href="{{ route('admin.users.show', $u) }}" class="text-blue-600 hover:underline">
                        Bekijk profiel
                    </a>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="p-3">Geen gebruikers gevonden.</td></tr>
        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
