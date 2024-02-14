<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="flex items-center gap-4 p-6">

        {{-- <button class="flex select-none items-center gap-3 rounded-lg py-3 px-6 text-center " type="button"
            data-ripple-light="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-5">
                <path fill="#ffffff"
                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
            </svg>
            <a href="{{ route('profile.CompleteCandidate') }}">
                Complete my profile
            </a>
        </button> --}}
        <div class="flex w-1/2 pl-4 text-sm">
            <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                <li class="mr-2">
                    <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:underline py-2 px-2"
                        href="{{ route('profile.CompleteCandidate') }}">Complete my profile</a>
                </li>
                
            </ul>
        </div>

    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div> --}}

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('More Informations') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Update your account's profile information and email address.") }}
                        </p>
                    </header>

                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="POST" action="{{ route('profile.updateCandidate') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')


                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div>
                                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                        {{ __('Your email address is unverified.') }}

                                        <button form="send-verification"
                                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div>
                            <x-input-label for="profile_pic" :value="__('Profile picture')" />
                            <x-text-input id="profile_pic" name="profile_pic" type="text" class="mt-1 block w-full"
                                :value="old('profile_pic', $user->profile_pic)" required autofocus autocomplete="profile_pic" />
                            <x-input-error class="mt-2" :messages="$errors->get('profile_pic')" />
                        </div>

                        <div>
                            <x-input-label for="titre" :value="__('Title')" />
                            <x-text-input id="titre" name="titre" type="text" class="mt-1 block w-full"
                                :value="old('titre', $user->titre)" required autofocus autocomplete="titre" />
                            <x-input-error class="mt-2" :messages="$errors->get('titre')" />
                        </div>

                        <div>
                            <x-input-label for="poste_actuel" :value="__('Current post')" />
                            <x-text-input id="poste_actuel" name="poste_actuel" type="text" class="mt-1 block w-full"
                                :value="old('poste_actuel', $user->poste_actuel)" required autofocus autocomplete="poste_actuel" />
                            <x-input-error class="mt-2" :messages="$errors->get('poste_actuel')" />
                        </div>

                        <div>
                            <x-input-label for="industrie" :value="__('Industry')" />
                            <x-text-input id="industrie" name="industrie" type="text" class="mt-1 block w-full"
                                :value="old('industrie', $user->industrie)" required autofocus autocomplete="industrie" />
                            <x-input-error class="mt-2" :messages="$errors->get('industrie')" />
                        </div>
                        <div>
                            <x-input-label for="adresse" :value="__('Adress')" />
                            <x-text-input id="adresse" name="adresse" type="text" class="mt-1 block w-full"
                                :value="old('adresse', $user->industrie)" required autofocus autocomplete="adresse" />
                            <x-input-error class="mt-2" :messages="$errors->get('adresse')" />
                        </div>
                        <div>
                            <x-input-label for="informations" :value="__('More Informations')" />
                            <x-text-input id="informations" name="informations" type="text" class="mt-1 block w-full"
                                :value="old('informations', $user->informations)" required autofocus autocomplete="informations" />
                            <x-input-error class="mt-2" :messages="$errors->get('informations')" />
                        </div>


                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>

                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
