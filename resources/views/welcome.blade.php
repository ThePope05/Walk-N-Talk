<x-base-page>
    @auth
    <span class="hidden" id="userId">{{ auth()->id() }}</span>
    <div class="bg-white shadow-custom-lg rounded-full h-96 w-96 flex justify-center items-center">
        <button id="QueueButton" onclick="toggleQueueing()" class="bg-[#519F66] cursor-pointer rounded-full w-[250px] h-[250px] flex justify-center items-center">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <p id="queue-time" class="w-3/4 text-4xl text-center hidden font-black text-[#F8F6EF]">00:00</p>

            <img id="queue-img" src="{{ asset('/img/WalkNTalk.png') }}" class="w-3/4" alt="WalkNTalk">
        </button>

        <div id="match-found-screen" class="bg-[#0005] absolute hidden w-screen h-screen top-0 left-0 justify-center items-center">
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
        var _queuedAt = null;
        const userId = document.querySelector("#userId").innerHTML;
        const queueImgEl = document.querySelector("#queue-img");
        const queueTimeEl = document.querySelector("#queue-time");

        async function toggleQueueing() {
            await isQueueing();
            if (_isQueueing) {
                await fetch("user/queue/stop")
                    .then(function(repsonse) {
                        if (!repsonse.ok) return;

                        queueTimeEl.classList.add("hidden");
                        queueImgEl.classList.remove("hidden");
                        queueImgEl.classList.add("flex");
                        _isQueueing = false;
                    });
            } else {
                await fetch("user/queue/start")
                    .then(function(repsonse) {
                        if (!repsonse.ok) return;

                        queueTimeEl.classList.remove("hidden");
                        queueImgEl.classList.add("hidden");
                        queueImgEl.classList.remove("flex");
                        _queuedAt = new Date();
                        _isQueueing = true;
                    });
            }
        }

        async function isQueueing() {
            try {
                fetch('user/queue/isQueueing')
                    .then(async function(response) {
                        if (!response.ok) return;
                        _isQueueing = await response.json();
                    })
            } catch (e) {
                console.error(e);
            }
        }


        function update() {
            isQueueing();

            if (_queuedAt == null || !_isQueueing) return;

            const now = new Date();
            const diffSec = Math.floor((now - _queuedAt) / 1000);
            const minutes = Math.floor(diffSec / 60);
            const seconds = diffSec % 60;
            queueTimeEl.textContent = `${String(minutes).padStart(2,"0")}:${String(seconds).padStart(2,"0")}`;
            checkMatchMade();
        }


        update(); // run immediately
        setInterval(update, 1000); // then every second

        async function checkMatchMade() {
            fetch('/user/hasUnfinishedWalk')
                .then(async function(response) {
                    if (!response.ok) return;

                    var hasUnfinishedWalk = await response.json();
                    if (hasUnfinishedWalk)
                        window.open('/match', '_self');
                });
        }
    </script>
</x-base-page>