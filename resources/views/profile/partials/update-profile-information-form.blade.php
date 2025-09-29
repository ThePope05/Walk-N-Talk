<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>


        @if($user->is_admin)
            <p class="mt-4 text-sm text-green-700 font-semibold">
                Jij bent een Admin 👑 </p>
        @endif


    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
    @csrf
    @method('patch')

    {{-- bestaand: name --}}
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
            :value="old('name', $user->name)" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    {{-- bestaand: email + verify blok --}}
    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
            :value="old('email', $user->email)" required autocomplete="username" />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
    </div>

    {{-- NIEUW: Volledige naam --}}
    <div>
        <x-input-label for="full_name" value="Volledige naam" />
        <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full"
            :value="old('full_name', $user->full_name)" />
        <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
    </div>

    {{-- NIEUW: Bio --}}
    <div>
        <x-input-label for="bio" value="Bio" />
        <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('bio', $user->bio) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('bio')" />
    </div>

    {{-- NIEUW: Avatar upload + preview --}}
    <div>
        <x-input-label for="avatar" value="Avatar" />
        <input id="avatar" name="avatar" type="file" accept="image/*" class="mt-1 block w-full">
        <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        @if ($user->avatar_path)
            <img src="{{ asset('storage/'.$user->avatar_path) }}"
                 alt="avatar" class="mt-3 h-16 w-16 rounded-full object-cover border" />
        @endif
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>

        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition
               x-init="setTimeout(() => show = false, 2000)"
               class="text-sm text-gray-600">{{ __('Saved.') }}</p>
        @endif
    </div>
</form>

</section>
