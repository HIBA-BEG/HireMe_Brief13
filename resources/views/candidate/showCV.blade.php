{{-- 
    <?php
    echo $CV[0]->id;
    ?> --}}

<x-app-layout>
    <!-- component nav bar -->
    <div class="antialiased bg-gray-100 dark-mode:bg-gray-900">
        <div class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
            <div x-data="{ open: true }"
                class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
                <div class="flex flex-row items-center justify-between p-4">
                    <a href="#"
                        class="text-lg font-semibold tracking-widest text-gray-900 rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">HireMe</a>
                    <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                            <path x-show="!open" fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                            <path x-show="open" fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <nav :class="{ 'flex': open, 'hidden': !open }"
                    class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
                    <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        href="{{ route('candidate.home') }}">{{ __('Home') }}</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        href="{{ route('profile.ShowProfileCandidate') }}">{{ __('My Profile') }}</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        href="{{ route('profile.CompleteCandidate') }}"> {{ __('Complete My Profile') }}</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        href="{{ route('profile.editCandidate') }}"> {{ __('Profile') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </nav>
            </div>
        </div>
    </div>
    <!-- component -->

    <!-- Main modal -->
    <div
        class=" top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="flex justify-center">
                @if ($cv)

                <div class="mt-4 bg-white w-96 h-96 rounded-lg h-full hidden" id="CvCard">
                    <div class="flex p-2 gap-1">
                        <div class="">
                            <span class="bg-blue-500 inline-block center w-3 h-3 rounded-full"></span>
                        </div>
                        <div class="circle">
                            <span class="bg-purple-500 inline-block center w-3 h-3 rounded-full"></span>
                        </div>
                        <div class="circle">
                            <span class="bg-pink-500 box inline-block center w-3 h-3 rounded-full"></span>
                        </div>
                    </div>
                    <div class="p-2">
                        <h2 class="text-2xl font-bold mb-4 flex justify-center text-purple-600 underline">My CV</h2>
                        <h3 class="text-xl font-bold text-pink-500">Competences:</h3>
                        <ul class="p-4">
                            @foreach (json_decode($cv->competences) as $competence)
                                <li class="list-disc p-1">{{ $competence }}</li>
                            @endforeach
                        </ul>
                        <h3 class="text-xl font-bold text-blue-500">Experiences:</h3>
                        <ul class="p-4">
                            @foreach (json_decode($cv->experiences) as $experience)
                                <li class="list-disc p-1">{{ $experience }}</li>
                            @endforeach
                        </ul>
                        <h3 class="text-xl font-bold text-purple-500">Cursus:</h3>
                        <ul class="p-4">
                            @foreach (json_decode($cv->cursus) as $cursuss)
                                <li class="list-disc p-1">{{ $cursuss }}</li>
                            @endforeach
                        </ul>
                        <h3 class="text-xl font-bold text-pink-500">Langues:</h3>
                        <ul class="p-4">
                            @foreach (json_decode($cv->langues) as $langue)
                                <li class="list-disc p-1">{{ $langue }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @else
                <p class="text-gray-600">No CV created yet.</p>
            @endif
            </div>
        </div>
    </div>
    <script>
        function addInput() {
            var newInput = document.createElement("input");
            newInput.type = "text";
            newInput.name = "required_skills[]";
            newInput.className =
                "bg-gray-50 border border-gray-300 text-gray-900 text-sm  mb-2 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-80 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500";
            newInput.placeholder = "Enter the required skills";
            document.getElementById("required_skills").parentNode.appendChild(newInput);
        }

        function addInputCompetences() {
            var newInput = document.createElement("input");
            newInput.type = "text";
            newInput.name = "competences[]";
            newInput.className =
                "bg-gray-50 border border-gray-300 text-gray-900 text-sm  mb-2 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-80 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500";
            newInput.placeholder = "Entrer les competences";
            document.getElementById("competences").parentNode.appendChild(newInput);
        }

        function addInputExperiences() {
            var newInput = document.createElement("input");
            newInput.type = "text";
            newInput.name = "experiences[]";
            newInput.className =
                "bg-gray-50 border border-gray-300 text-gray-900 text-sm  mb-2 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-80 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500";
            newInput.placeholder = "Entrer les experiences";
            document.getElementById("experiences").parentNode.appendChild(newInput);
        }

        function addInputCursus() {
            var newInput = document.createElement("input");
            newInput.type = "text";
            newInput.name = "cursus[]";
            newInput.className =
                "bg-gray-50 border border-gray-300 text-gray-900 text-sm  mb-2 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-80 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500";
            newInput.placeholder = "Entrer le cursus";
            document.getElementById("cursus").parentNode.appendChild(newInput);
        }

        function addInputLangues() {
            var newInput = document.createElement("input");
            newInput.type = "text";
            newInput.name = "langues[]";
            newInput.className =
                "bg-gray-50 border border-gray-300 text-gray-900 text-sm  mb-2 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-80 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500";
            newInput.placeholder = "Entrer les langues ";
            document.getElementById("langues").parentNode.appendChild(newInput);
        }

    </script>


</x-app-layout>
