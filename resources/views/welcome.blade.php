<x-base-page>
    @auth
    <span class="hidden" id="userId">{{ auth()->id() }}</span>
    <div class="bg-white shadow-custom-lg rounded-full h-96 w-96 flex justify-center items-center">
        <a id="QueueButton" onclick="toggleQueueing" class="bg-[#519F66] rounded-full w-[250px] h-[250px] flex justify-center items-center">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <p id="queue-time" class="w-3/4 text-4xl text-center font-black text-[#F8F6EF]"></p>

            <img id="queue-img" src="{{ asset('/img/WalkNTalk.png') }}" class="w-3/4" alt="WalkNTalk">
        </a>

        <div class="bg-[#0005] absolute hidden w-screen h-screen top-0 left-0 justify-center items-center">
            <div class="bg-[#F0E6C2] rounded-lg w-2/5 pb-6 flex flex-col justify-center items-center">
                <h3 class="text-[#519F66] text-4xl font-black text-center pt-4">Partner gevonden!</h3>
                <hr class="border-[#519F66] border-2 my-3 w-3/5 mx-auto">
                <a id="accept-match" class="bg-[#519F66] px-12 py-6 rounded-lg text-3xl text-[#F0E6C2] font-black cursor-pointer">Accepteer</a>
            </div>
        </div>
    </div>
    @endauth
    <script>
        var _isQueueing = false;
        const userId = document.querySelector("#userId").innerHTML;
        const queueImgEl = document.querySelector("#queue-img");
        const queueTimeEl = document.querySelector("#queue-time");

        function toggleQueueing() {
            if (isQueueing()) {
                fetch("/user/queue/stop");
                queueTimeEl.classList.add("hidden");
                queueImgEl.classList.remove("hidden");
                queueImgEl.classList.add("flex");
                _isQueueing = false;
            } else {
                fetch("/user/queue/start");
                queueTimeEl.classList.remove("hidden");
                queueImgEl.classList.add("hidden");
                queueImgEl.classList.remove("flex");
                _isQueueing = true;
            }
        }

        async function isQueueing() {
            var data = await fetch('user/queue/isQueueing');
            var isQueueing = await data.json();
            return isQueueing;
        }

        // TODO: move the start/stop queue to an api request too. 
        async function loadQueue() {
            if (!(await isQueueing()))
                return;

            try {
                var unacceptedMatch = await fetch('/unacceptedMatch/entries/' + userId);
                unacceptedMatch = await unacceptedMatch.json();

                if (unacceptedMatch > 0) {
                    const acceptBtn = document.querySelector("#accept-match");
                    fetch('/user/stop/queue');
                    acceptBtn.addEventListener('onClick', () => {});
                    return;
                }

                var queueEntries = await fetch('/queue/entries');
                queueEntries = await queueEntries.json();

                console.log(queueEntries);

                queueEntries.forEach(queueEntry => {
                    createMatch(queueEntry.user_id);
                });
            } catch (e) {
                console.error("Error fetching queue: ", e);
            }
        }

        loadQueue();
        setInterval(loadQueue, 1000);

        function startTimer() {
            if (!_isQueueing)
                return;

            const el = document.getElementById("queue-time");
            const queuedAt = el.getAttribute("data-queued-at");

            // Parse into JS Date
            const dateQueued = new Date(queuedAt.replace(" ", "T")); // safer for ISO parsing

            function update() {
                const timeZone = "Europe/Paris";

                // Force both times into CET
                const now = new Date(
                    new Date().toLocaleString("en-US", {
                        timeZone
                    })
                );
                const queued = new Date(
                    dateQueued.toLocaleString("en-US", {
                        timeZone
                    })
                );

                const diffSec = Math.floor((now - queued) / 1000);

                const minutes = Math.floor(diffSec / 60);
                const seconds = diffSec % 60;

                el.textContent = `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
            }


            update(); // run immediately
            setInterval(update, 1000); // then every second
        }

        startTimer();

        function createMatch(_otherUserId) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            console.log("Starting match between current user and " + _otherUserId);
            fetch("/walkMatch", {
                method: "POST",
                body: JSON.stringify({
                    otherUserId: _otherUserId
                }),
                headers: {
                    "Content-type": "application/json; charset=UTF-8",
                    "X-CSRF-TOKEN": token
                }
            });
        }

        const eventSource = new EventSource("/events");

        eventSource.onmessage = (e) => {
            if (isQueueing())
                return;
            const data = JSON.parse(e.data);
            if (data.url) {
                window.location.href = data.url;
            }
        };
    </script>
</x-base-page>