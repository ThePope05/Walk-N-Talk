{{-- resources/views/profile/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profiel
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-md mx-auto px-4">
            {{-- Telefoon-card look --}}
            <div class="bg-[#F7F4EB] rounded-3xl shadow-xl overflow-hidden">

                {{-- Top bar --}}
                <div class="bg-[#EBDFAF] px-4 pt-4 pb-6 relative">
                    <a href="{{ url()->previous() }}"
                       class="absolute left-4 top-4 inline-flex items-center justify-center w-9 h-9 rounded-xl bg-black/10 hover:bg-black/20 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>

                    <h1 class="text-center text-lg font-semibold text-black">My Profile</h1>

                    {{-- Avatar + naam --}}
                    <div class="mt-4 flex flex-col items-center">
                        <div class="p-1 rounded-md border-2 border-blue-400">
                            <div class="w-16 h-16 rounded-md bg-white/70 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-black/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a8.25 8.25 0 0115 0"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 text-center text-lg font-semibold text-black">
                            {{ $user->name }}
                        </div>
                    </div>
                </div>

                @if(auth()->id() === $user->id)
                    {{-- ========== EIGEN PROFIEL (editable) ========== --}}
                    <form method="POST" action="{{ route('profile.update') }}" class="px-5 py-6 space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="text-[11px] tracking-wide font-semibold text-black/70">FIRST NAME</label>
                            <input name="first_name" value="{{ old('first_name', $user->first_name ?? '') }}"
                                   class="mt-1 w-full rounded-2xl bg-[#EBDFAF] placeholder-black/40 text-black px-4 py-3 shadow-sm outline-none focus:ring-2 focus:ring-blue-300"/>
                        </div>

                        <div>
                            <label class="text-[11px] tracking-wide font-semibold text-black/70">LAST NAME</label>
                            <input name="last_name" value="{{ old('last_name', $user->last_name ?? '') }}"
                                   class="mt-1 w-full rounded-2xl bg-[#EBDFAF] placeholder-black/40 text-black px-4 py-3 shadow-sm outline-none focus:ring-2 focus:ring-blue-300"/>
                        </div>

                        <div>
                            <label class="text-[11px] tracking-wide font-semibold text-black/70">TRIBE</label>
                            <input name="tribe" value="{{ old('tribe', $user->tribe ?? '') }}"
                                   class="mt-1 w-full rounded-2xl bg-[#EBDFAF] placeholder-black/40 text-black px-4 py-3 shadow-sm outline-none focus:ring-2 focus:ring-blue-300"/>
                        </div>

                        <div>
                            <label class="text-[11px] tracking-wide font-semibold text-black/70">MOBILE NUMBER</label>
                            <input name="mobile" value="{{ old('mobile', $user->mobile ?? '') }}"
                                   class="mt-1 w-full rounded-2xl bg-[#EBDFAF] placeholder-black/40 text-black px-4 py-3 shadow-sm outline-none focus:ring-2 focus:ring-blue-300"/>
                        </div>

                        <div>
                            <label class="text-[11px] tracking-wide font-semibold text-black/70">EMAIL</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="mt-1 w-full rounded-2xl bg-[#EBDFAF] placeholder-black/40 text-black px-4 py-3 shadow-sm outline-none focus:ring-2 focus:ring-blue-300"/>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <button type="submit"
                                    class="inline-flex items-center justify-center px-5 py-2.5 rounded-full bg-[#4BA66A] text-white font-semibold shadow-[0_4px_0_#2e6f45] active:translate-y-[2px] active:shadow-[0_2px_0_#2e6f45]">
                                Save
                            </button>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-full bg-[#C7514B] text-white font-semibold shadow-[0_4px_0_#8b3430] active:translate-y-[2px] active:shadow-[0_2px_0_#8b3430]">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </form>
                @else
                    {{-- ========== ANDERMANS PROFIEL (read-only + No Show) ========== --}}
                    <div class="px-5 py-6 space-y-3">
                        <div class="space-y-1 text-sm">
                            <p><span class="font-semibold">Naam:</span> {{ $user->name }}</p>
                            <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                            <p><span class="font-semibold">Volledige naam:</span> {{ $user->full_name ?? '-' }}</p>
                            <p><span class="font-semibold">Bio:</span> {{ $user->bio ?? '-' }}</p>
                            <p><span class="font-semibold">Rol:</span> {{ $user->is_admin ? 'Admin' : 'Student' }}</p>
                            <p><span class="font-semibold">Aangemaakt op:</span> {{ $user->created_at->format('d-m-Y H:i') }}</p>
                        </div>

                        <div class="mt-4 p-4 rounded-2xl border border-black/10 bg-white">
                            <h3 class="font-semibold text-lg mb-3">No Show meldingen</h3>

                            <p class="mb-4">
                                Totaal aantal meldingen:
                                <span class="font-semibold">{{ $user->no_show_reports_received_count ?? 0 }}</span>
                            </p>

                            @auth
                                @if (auth()->id() !== $user->id)
                                    <form method="POST" action="{{ route('users.no_show.store', $user) }}"
                                          onsubmit="return confirm('Weet je zeker dat je een No Show melding wilt registreren voor {{ $user->name }}?');"
                                          class="mb-4 space-y-2">
                                        @csrf
                                        <x-input-label for="reason" value="Opmerking (optioneel)" />
                                        <textarea id="reason" name="reason" rows="2"
                                                  class="w-full rounded-2xl bg-[#EBDFAF] px-4 py-3 shadow-sm outline-none focus:ring-2 focus:ring-blue-300"
                                                  placeholder="Waarom No Show? (optioneel)"></textarea>

                                        <x-primary-button class="!bg-red-600 hover:!bg-red-700">
                                            🚨 No Show melden
                                        </x-primary-button>
                                    </form>
                                @endif
                            @endauth

                            @if($user->relationLoaded('noShowReportsReceived') && $user->noShowReportsReceived->isNotEmpty())
                                <div class="mt-4">
                                    <h4 class="font-medium mb-2">Recente meldingen</h4>
                                    <ul class="list-disc ms-5 space-y-1 text-sm">
                                        @foreach($user->noShowReportsReceived as $rep)
                                            <li>
                                                Door <span class="font-medium">{{ $rep->reporter?->name ?? 'Onbekend' }}</span>
                                                op {{ $rep->created_at->format('d-m-Y H:i') }}
                                                @if($rep->reason)
                                                    — “{{ $rep->reason }}”
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <p class="text-sm text-gray-600">Nog geen meldingen.</p>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Logo onderin --}}
                <div class="px-5 pb-8">
                    <div class="mt-2 flex flex-col items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-[#4BA66A] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13 5a2 2 0 11-4 0 2 2 0 014 0z"/><path fill-rule="evenodd" d="M4 6a4 4 0 118 0v2a4 4 0 11-8 0V6zm13.293 5.293a1 1 0 011.414 0l1 1A1 1 0 0119 13h-2v6a1 1 0 11-2 0v-6h-2a1 1 0 01-.707-1.707l1-1A1 1 0 0114 10h2.586l.707.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="text-3xl font-extrabold tracking-tight leading-none text-[#2E7E4E]">
                                <div>Walk</div>
                                <div>&amp;Talk</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> {{-- /card --}}
        </div>
    </div>
</x-app-layout>
