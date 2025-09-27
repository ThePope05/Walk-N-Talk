<x-base-page>
    <div id="question-list">

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