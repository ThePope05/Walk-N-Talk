<?php

use Illuminate\Support\Facades\Auth;

//dd($match);
$otherUser = $match->user_id_1 == Auth::id()
    ? $match->user2
    : $match->user1;
?>

<x-base-page>
    <div class="flex items-center flex-col w-full">
        <h1 class="bg-[#F0E6C2] text-5xl rounded-2xl w-2/5 max-sm:w-3/4 py-12 text-center font-lalezar font-bold">Match gevonden!</h1>
        <div class="bg-[#F0E6C2] rounded-2xl w-2/5 max-sm:w-3/4 py-2 my-4"></div>
        <div class="flex items-center flex-col bg-[#F0E6C2] rounded-2xl w-2/5 max-sm:w-3/4 p-4">
            <p class="w-full text-center text-xl mb-4">Je hebt een match met <span class="font-black">{{ $otherUser->firstName }} {{ $otherUser->lastName }}</span>. <br> Vind elkaar hier</p>
            <img class="w-3/5 max-sm:w-3/4 rounded-2xl" src="{{ asset('/img/aula.avif') }}" alt="Afspreek plek, onderaan roltrap. Heidelberglaan 15">
            <a class="w-3/5 max-sm:w-3/4 rounded-2xl bg-[#519F66] text-[#F8F6EF] text-center mt-4 text-2xl py-2" href="{{ route('ice-breakers') }}">Gevonden!</a>
        </div>
    </div>
</x-base-page>