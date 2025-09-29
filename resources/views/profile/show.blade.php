<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mijn profiel
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center">
        <div class="w-full max-w-md bg-[#F7F4EB] rounded-3xl shadow-xl overflow-hidden" data-testid="profile-new">

            {{-- Topbar --}}
            <div class="bg-[#EBDFAF] px-4 pt-4 pb-6 relative">
                <h1 class="text-center text-lg font-semibold text-black">My Profile</h1>

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

            {{-- Form fields volgens mockup (read-only of editable; hier editable voorbeeld) --}}
            <form method="POST" action="{{ route('profile.update') }}" class="px-5 py-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-[11px] tracking-wide font-semibold text-black/70">FIRST NAME</label>
                    <input name="first_name" value="{{ old('first_name', $user->first_name) }}"
                           class="mt-1 w-full rounded-2xl bg-[#EBDFAF] px-4 py-3 shadow-sm outline-none focus:ring-2 focus:ring-blue-300"/>
                </div>

                <div>
                    <label class="text-[11px] tracking-wide font-semibold text-black/70">LAST NAME</label>
                    <input name="last_name" value="{{ old('last_name', $user->last_name) }}"
                           class="mt-1 w-full rounded-2xl bg-[#EBDFAF] px-4 py-3 shadow-sm outline-none focus:ring-2 focus:ring-blue-300"/>
                </div>

                <div>
                    <label class="text-[11px] tracking-wide font-semibold text-black/70">TRIBE</label>
                    <input name="tribe" value="{{ old('tribe', $user->tribe) }}"
                           class="mt-1 w-full rounded-2xl bg-[#EBDFAF] px-4 py-3 shadow-sm outline-none focus:ring-2 focus:ring-blue-300"/>
                </div>

                <div>
                    <label class="text-[11px] tracking-wide font-semibold text-black/70">MOBILE NUMBER</label>
                    <input name="mobile" value="{{ old('mobile', $user->mobile) }}"
                           class="mt-1 w-full rounded-2xl bg-[#EBDFAF] px-4 py-3 shadow-sm outline-none focus:ring-2 focus:ring-blue-300"/>
                </div>

                <div>
                    <label class="text-[11px] tracking-wide font-semibold text-black/70">EMAIL</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="mt-1 w-full rounded-2xl bg-[#EBDFAF] px-4 py-3 shadow-sm outline-none focus:ring-2 focus:ring-blue-300"/>
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

        </div>
    </div>
</x-app-layout>
