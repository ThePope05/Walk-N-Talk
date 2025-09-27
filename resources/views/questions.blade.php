<x-base-page>
    <div id="question-list">
        <a class="rounded-2xl bg-[#519F66] text-[#F8F6EF] text-center mt-4 text-2xl py-2 px-14 absolute left-4" href="{{ route('ice-breakers') }}">Terug</a>
        <h1 class="question-title">{{ ucfirst($category) }} vragen</h1>

        <ul>
            @forelse($questions as $question)
            <div class="question-card">
                {{ $question }}
            </div>
            @empty
            <p>Geen vragen gevonden voor deze categorie.</p>
            @endforelse

        </ul>
    </div>
</x-base-page>