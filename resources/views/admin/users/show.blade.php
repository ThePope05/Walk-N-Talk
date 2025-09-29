<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profiel van {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p><strong>Naam:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Volledige naam:</strong> {{ $user->full_name ?? '-' }}</p>
                <p><strong>Bio:</strong> {{ $user->bio ?? '-' }}</p>
                <p><strong>Rol:</strong> {{ $user->is_admin ? 'Admin' : 'User' }}</p>
                <p><strong>Aangemaakt op:</strong> {{ $user->created_at->format('d-m-Y H:i') }}</p>

                {{-- 👇 alleen tonen als admin of eigenaar --}}
                @can('update', $user)
                <a href="{{ route('users.edit', $user) }}"
                    class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Profiel bewerken
                </a>
                @endcan


            </div>
        </div>
    </div>

        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')

            <!-- velden ... -->

            <x-primary-button>Opslaan</x-primary-button>
        </form>

        {{-- ========== No Show beheer (Admin) ========== --}}
<div class="mt-8 p-4 bg-gray-50 border rounded">
    <h3 class="font-semibold text-lg mb-3">No Show meldingen</h3>

    {{-- Totaal + bulk verwijderen --}}
    <div class="flex items-center gap-4 mb-4">
        <span>Totaal: <strong>{{ $user->no_show_reports_received_count ?? $user->noShowReportsReceived()->count() }}</strong></span>

        <form method="POST" action="{{ route('admin.users.no_shows.destroy_all', $user) }}"
              onsubmit="return confirm('Weet je zeker dat je ALLE No Show meldingen voor {{ $user->name }} wilt verwijderen?');">
            @csrf
            @method('DELETE')
            <x-secondary-button>Alles verwijderen</x-secondary-button>
        </form>
    </div>

    @php
        // Zorg dat de relatie is geladen met reporter; anders even laden:
        if (! $user->relationLoaded('noShowReportsReceived')) {
            $user->load(['noShowReportsReceived' => fn($q) => $q->with('reporter')->latest()]);
        }
    @endphp

    @if($user->noShowReportsReceived->isEmpty())
        <p class="text-sm text-gray-600">Geen meldingen.</p>
    @else
        <div class="space-y-3">
            @foreach($user->noShowReportsReceived as $rep)
                <div class="flex items-start justify-between gap-3 p-3 bg-white border rounded">
                    <div>
                        <div class="text-sm">
                            Door <span class="font-medium">{{ $rep->reporter?->name ?? 'Onbekend' }}</span>
                            op {{ $rep->created_at->format('d-m-Y H:i') }}
                        </div>
                        @if($rep->reason)
                            <div class="text-xs text-gray-700 mt-1">“{{ $rep->reason }}”</div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('admin.no_shows.destroy', $rep) }}"
                          onsubmit="return confirm('Melding van {{ $rep->reporter?->name ?? 'onbekend' }} verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>Verwijderen</x-danger-button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>


</x-app-layout>
