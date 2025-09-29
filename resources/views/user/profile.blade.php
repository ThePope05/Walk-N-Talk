<x-base-page>
    @if(session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.profile.update') }}" method="POST" class="w-3/5">
        @csrf
        @method('PUT')

        <h1 class="text-5xl font-bold text-[#666562] mb-6">Profiel</h1>

        <div class="flex flex-col mt-3 w-full">
            <label for="firstName">Voornaam:</label>
            <input type="text" name="firstName" id="firstName"
                   class="border-b-2 border-[#b4b3ad]"
                   value="{{ Auth::user()->firstName }}" />
        </div>

        <div class="flex flex-col mt-3 w-full">
            <label for="lastName">Achternaam:</label>
            <input type="text" name="lastName" id="lastName"
                   class="border-b-2 border-[#b4b3ad]"
                   value="{{ Auth::user()->lastName }}" />
        </div>

        <div class="flex flex-col mt-3 w-full">
            <label for="tribe">Tribe:</label>
            <input type="text" name="tribe" id="tribe"
                   class="border-b-2 border-[#b4b3ad]"
                   value="{{ Auth::user()->tribe }}" />
        </div>

        <div class="flex flex-col mt-3 w-full">
            <label for="number">Telefoonnummer:</label>
            <input type="text" name="number" id="number"
                   class="border-b-2 border-[#b4b3ad]"
                   value="{{ Auth::user()->number }}" />
        </div>

        <div class="flex flex-col mt-3 w-full">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email"
                   class="border-b-2 border-[#b4b3ad]"
                   value="{{ Auth::user()->email }}" />
        </div>

        <!-- Buttons container -->
        <div class="flex gap-4 mt-6">
            <!-- Opslaan knop -->
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Opslaan
            </button>

            <!-- Uitloggen formulier buiten update form, maar in dezelfde flex container -->
            <form method="POST" action="{{ route('user.logout') }}">
                @csrf
                <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded">
                    Uitloggen
                </button>
            </form>
        </div>
    </form>
</x-base-page>
