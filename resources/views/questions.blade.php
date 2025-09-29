<x-base-page>
    <div id="question-list">
        <a class="rounded-2xl bg-[#519F66] text-[#F8F6EF] text-center mt-4 text-2xl py-2 px-14 absolute  max-sm:w-3/4 min-sm:left-4" href="{{ route('ice-breakers') }}">Terug</a>
        <h1 class="question-title  max-sm:pt-16">{{ ucfirst($category) }} vragen</h1>

        <ul class="w-full flex flex-col items-center">
            @forelse($questions as $question)
            <div class="question-card max-sm:w-3/4 w-3/5">
                {{ $question }}
            </div>
            @empty
            <p>Geen vragen gevonden voor deze categorie.</p>
            @endforelse

        </ul>
    </div>
</x-base-page>