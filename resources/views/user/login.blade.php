<x-base-page>
    @section('users_online')
    {{ $users_online }}
    @endsection
    <form class="w-3/5 flex flex-col items-center" action="{{ route('login') }}" method="post">
        <h1 class="text-5xl font-bold text-[#666562]">Login</h1>
        @csrf
        <div class="flex flex-col mt-3 w-full">
            <label for="email" class="">Email</label>
            <input type="email" name="email" class=" border-b-2 border-[#b4b3ad]" value="{{ old('email') }}">
        </div>
        <div class="flex flex-col mt-3 w-full">
            <label for="password" class="">Wachtwoord</label>
            <input type="password" name="password" class=" border-b-2 border-[#b4b3ad]" value="{{ old('password') }}">
        </div>
        <div class="flex justify-center mt-6 w-full">
            <button type="submit" class="text-center text-[#F7F6ED] font-bold bg-[#519F66] drop-shadow-md p-8 py-2 w-3/6 rounded-full">LOGIN</button>
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-red-600 mt-2">{{ $error }}</p>
            @endforeach
        @endif
    </form>
</x-base-page>