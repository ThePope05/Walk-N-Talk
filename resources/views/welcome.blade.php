<x-base-page>
    @auth
    <div class="bg-white shadow-custom-lg rounded-full h-96 w-96 flex justify-center items-center">
        @if (isset($userIsQueueing))
        <a id="QueueButton" href="{{ ($userIsQueueing) ? route('queue.stop') : route('queue.start') }}" class="bg-[#519F66] rounded-full w-[250px] h-[250px] flex justify-center items-center">
            @if ($userIsQueueing)
            <p id="queue-time" data-queued-at="{{ $queued_at }}" class="w-3/4 text-4xl text-center font-black text-[#F8F6EF]"></p>
            <div id="queue-list"></div>
            @else
            <img src="{{ asset('/img/WalkNTalk.png') }}" class="w-3/4" alt="WalkNTalk">
            @endif
        </a>
        @endif
    </div>
    @endauth
    <script>
    async function loadQueue() {
        try {
            const res = await fetch('/queue/entries');
            const data = await res.json();

            console.log(data);

            const container = document.getElementById("queue-list");
            container.innerHTML = ""; // clear old list

            data.forEach(entry => {
                // Do Something with queues
            });
        } catch (e) {
            console.error("Error fetching queue:", e);
        }
    }

    loadQueue();
    setInterval(loadQueue, 1000);


    function startTimer() {
        const el = document.getElementById("queue-time");
        const queuedAt = el.getAttribute("data-queued-at");

        // Parse into JS Date
        const dateQueued = new Date(queuedAt.replace(" ", "T")); // safer for ISO parsing

        function update() {
            const now = new Date();
            const diffSec = Math.floor((now - dateQueued) / 1000);

            const minutes = Math.floor(diffSec / 60);
            const seconds = diffSec % 60;

            el.textContent = `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
        }

        update(); // run immediately
        setInterval(update, 1000); // then every second
    }

    startTimer();



    function createMatch(user1, user2)
    {
        fetch ("/walkMatch", {
            method: "POST",
            body: JSON.stringify({
                user_id_1: user1,
                user_id_2: user2
            }),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        });
    }
    </script>
</x-base-page>