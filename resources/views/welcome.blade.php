<x-base-page>
        <div class="blocks">
       <a href="{{ route('questions.show', 'Icebreaker') }}" class="btn">Ice breakers!</a>
        <a href="{{ route('questions.show', 'Deep talk') }}" class="btn">Deep talk</a>
        <a href="{{ route('questions.show', 'Joke hour') }}" class="btn">Joke hour</a>
        <a href="#" class="btn end-walk" onclick="openPopup(event)">Beëindig wandeling</a>
    </div>

    <div class="overlay" id="endWalkPopup">
        <div class="popup">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Wandeling beëindigd</h2>
            <div class="actions">
                <form method="POST" action="{{ route('walk.end') }}">
                    @csrf
                    <button type="submit" class="btn confirm">Bevestig</button>
                </form>
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