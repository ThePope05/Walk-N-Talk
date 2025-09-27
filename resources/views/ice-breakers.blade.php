<x-base-page>
    <div class="blocks">
        <a href="{{ route('questions.show', 'Icebreaker') }}" class="btn">Ice breakers!</a>
        <a href="{{ route('questions.show', 'Deep talk') }}" class="btn">Deep talk</a>
        <a href="{{ route('questions.show', 'Joke hour') }}" class="btn">Joke hour</a>
        <div class="bg-[#F0E6C2] rounded-2xl w-full py-2"></div>
        <a href="#" class="btn end-walk" onclick="openPopup(event)">Beëindig wandeling</a>
    </div>

    <div class="overlay" id="endWalkPopup">
        <div class="popup w-2/5 rounded-2xl py-8">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2 class="text-2xl font-bold text-center font-lalezar">Wandeling beëindigen</h2>
            <div class="actions">
                <a class="w-3/5 rounded-2xl bg-[#519F66] text-[#F8F6EF] text-center mt-4 text-2xl py-2" href="{{ route('ice-breakers') }}">Beëindig</a>
            </div>
        </div>
    </div>

    <script>
        function openPopup(event) {
            event.preventDefault();
            document.getElementById('endWalkPopup').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('endWalkPopup').style.display = 'none';
        }
    </script>
</x-base-page>