<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Complete My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

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

                    <form method="POST" action="{{ route('profile.storeCandidate') }}" class="mt-6 space-y-6" enctype="multipart/form-data" >
                        @csrf
                        @method('POST')


                        <div>
                            <x-input-label for="profile_pic" :value="__('Profile picture')" />
                            <x-text-input id="profile_pic" name="profile_pic" type="file" class="mt-1 block w-full"
                                required autofocus autocomplete="profile_pic" />
                            <x-input-error class="mt-2" :messages="$errors->get('profile_pic')" />
                        </div>

                        <div>
                            <x-input-label for="titre" :value="__('Title')" />
                            <x-text-input id="titre" name="titre" type="text" class="mt-1 block w-full"
                               required autofocus autocomplete="titre" />
                            <x-input-error class="mt-2" :messages="$errors->get('titre')" />
                        </div>

                        <div>
                            <x-input-label for="poste_actuel" :value="__('Current post')" />
                            <x-text-input id="poste_actuel" name="poste_actuel" type="text" class="mt-1 block w-full"
                               required autofocus autocomplete="poste_actuel" />
                            <x-input-error class="mt-2" :messages="$errors->get('poste_actuel')" />
                        </div>

                        <div>
                            <x-input-label for="industrie" :value="__('Industry')" />
                            <x-text-input id="industrie" name="industrie" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="industrie" />
                            <x-input-error class="mt-2" :messages="$errors->get('industrie')" />
                        </div>
                        <div>
                            <x-input-label for="adresse" :value="__('Adress')" />
                            <x-text-input id="adresse" name="adresse" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="adresse" />
                            <x-input-error class="mt-2" :messages="$errors->get('adresse')" />
                        </div>
                        <div>
                            <x-input-label for="informations" :value="__('More Informations')" />
                            <x-text-input id="informations" name="informations" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="informations" />
                            <x-input-error class="mt-2" :messages="$errors->get('informations')" />
                        </div>


                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            {{-- @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                            @endif --}}
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
