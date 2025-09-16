<x-base-page>
    @auth
    <div class="bg-white shadow-custom-lg rounded-full h-96 w-96 flex justify-center items-center">
        @if (isset($userIsQueueing))
        <a id="QueueButton" href="{{ ($userIsQueueing) ? route('queue.stop') : route('queue.start') }}" class="bg-[#519F66] rounded-full w-[250px] h-[250px] flex justify-center items-center">
            @if ($userIsQueueing)
            Stop queueing
            @else
            <img src="{{ asset('/img/WalkNTalk.png') }}" class="w-3/4" alt="WalkNTalk">
            @endif
        </a>
        @endif
    </div>
    @endauth
</x-base-page>