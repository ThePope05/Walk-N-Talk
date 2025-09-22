<x-base-page>
    @section('users_online')
    {{ $users_online }}
    @endsection
    <form class="w-3/5 flex flex-col items-center" action="{{ route('register') }}" method="post">
        <h1 class="text-5xl font-bold text-[#666562]">Register</h1>
        @csrf    
        <div class="flex mt-3 w-full justify-between">
            <div class="flex flex-col mt-3 w-[48%]">
                <label for="firstName" class="">Voornaam</label>
                <input type="text" name="firstName" class=" border-b-2 border-[#b4b3ad]" value="{{ old('firstName') }}">
            </div>
            <div class="flex flex-col mt-3 w-[48%]">
                <label for="lastName" class="">Achternaam</label>
                <input type="text" name="lastName" class=" border-b-2 border-[#b4b3ad]" value="{{ old('lastName') }}">
            </div>
        </div>
        <div class="flex flex-col mt-3 w-full">
            <label for="tribe" class="">Tribe</label>
            <input type="text" name="tribe" class=" border-b-2 border-[#b4b3ad]" value="{{ old('tribe') }}">
        </div>
        <div class="flex flex-col mt-3 w-full">
            <label for="number" class="">Telefoon nummer</label>
            <input type="text" name="number" class=" border-b-2 border-[#b4b3ad]" value="{{ old('number') }}">
        </div>
        <div class="flex flex-col mt-3 w-full">
            <label for="email" class="">Email</label>
            <input type="email" name="email" class=" border-b-2 border-[#b4b3ad]" value="{{ old('email') }}">
        </div>
        <div class="flex flex-col mt-3 w-full">
            <label for="password" class="">Wachtwoord</label>
            <input type="password" name="password" class=" border-b-2 border-[#b4b3ad]" value="{{ old('password') }}">
        </div>
        <div class="flex flex-col mt-3 w-full">
            <label for="confirmPassword" class="">Verifieer wachtwoord</label>
            <input type="password" name="confirmPassword" class=" border-b-2 border-[#b4b3ad]">
        </div>
        <div class="flex justify-center mt-6 w-full">
            <button type="submit" class="text-center text-[#F7F6ED] font-bold bg-[#519F66] drop-shadow-md p-8 py-2 w-3/6 rounded-full">MAAK ACCOUNT</button>
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-red-600 mt-2">{{ $error }}</p>
            @endforeach
        @endif
    </form>
</x-base-page>