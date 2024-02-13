<x-app-layout>
    @extends('layouts.master')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="ml-4 p-6 text-gray-900 dark:text-gray-100">

                    <!-- Modal toggle -->
                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                        class="block text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        Publier un offre
                    </button>
                </div>

                <div class="-mx-4 flex flex-wrap p-8">
                    @foreach ($offers as $offer)
                        <div class="px-4 md:w-1/2 lg:w-1/3">
                            <div
                                class="mb-9 bg-purple-100 rounded-xl py-8 px-7 shadow-md transition-all hover:shadow-lg sm:p-9 lg:px-6 xl:px-9">
                                <div class="mx-auto mb-7 inline-block w-8">
                                    <img src="{{ asset($offer->entreprise->photo) }}" alt="{{ $offer->entreprise->name }}">
                                </div>

                                {{-- <svg width="53" height="61"
                                        viewBox="0 0 53 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="20.8433" y="19.3018" width="10.1675" height="12.201" fill="#ABA8F7">
                                        </rect>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.1119 5.91343C40.9499 4.62242 39.4875 3.95192 38.2383 4.04801C36.1465 4.20891 33.9414 5.92602 31.8695 8.63549C30.0459 11.0202 28.5417 13.8917 27.5307 16.2458C33.6951 16.5488 37.7115 15.7786 40.1926 14.5916C42.7088 13.3878 43.5948 11.7969 43.7449 10.3715C43.9049 8.85254 43.2637 7.19309 42.1119 5.91343ZM8.75274 16.6855C6.24093 15.1295 4.93328 12.9984 4.69026 10.691C4.42078 8.13252 5.49249 5.64717 7.08955 3.87282C8.6764 2.10982 10.9989 0.817106 13.4643 1.00675C16.9349 1.27372 19.8489 3.94064 22.0221 6.78264C23.4868 8.69803 24.7428 10.8606 25.7343 12.8643C26.7259 10.8606 27.9818 8.69803 29.4465 6.78264C31.6197 3.94064 34.5337 1.27372 38.0043 1.00675C40.4697 0.817106 42.7922 2.10982 44.3791 3.87282C45.9761 5.64717 47.0478 8.13252 46.7784 10.691C46.5353 12.9984 45.2277 15.1295 42.7159 16.6855H49.8822C51.286 16.6855 52.4241 17.8236 52.4241 19.2274V31.1348C52.4241 32.5386 51.286 33.6766 49.8822 33.6766H49.3122V58.6608C49.3122 59.9464 48.1845 60.9886 46.7933 60.9886H31.5363L31.5191 60.9887L31.502 60.9886H20.3521L20.3349 60.9887L20.3178 60.9886H5.0608C3.66963 60.9886 2.54187 59.9464 2.54187 58.6608L2.54187 33.6766C1.13804 33.6766 0 32.5386 0 31.1348V19.2274C0 17.8236 1.13803 16.6855 2.54187 16.6855H8.75274ZM33.0443 58.1952H46.2895V33.6766H33.0443V58.1952ZM33.0443 30.6264H49.3738V19.7358H33.0443V30.6264ZM29.994 19.7358V30.6264H21.8601V19.7358H29.994ZM29.994 33.6766V58.1952H21.8601V33.6766H29.994ZM18.8098 58.1952V33.6766H5.56459V58.1952H18.8098ZM18.8098 30.6264V19.7358H3.05024V30.6264H18.8098ZM13.2303 4.04801C11.9811 3.95192 10.5187 4.62242 9.35668 5.91343C8.20488 7.19309 7.56373 8.85254 7.72372 10.3715C7.87385 11.7969 8.7598 13.3878 11.276 14.5916C13.7571 15.7786 17.7735 16.5488 23.9379 16.2458C22.9269 13.8917 21.4227 11.0202 19.5991 8.63549C17.5272 5.92602 15.3221 4.20891 13.2303 4.04801Z"
                                            fill="#6A64F1"></path>
                                    </svg> --}}
                                <div>
                                    <h3 class="mb-4 text-xl font-bold text-black sm:text-2xl lg:text-xl xl:text-2xl">
                                        {{ $offer->titre }}</h3>
                                    <p class="text-base font-medium text-body-color">{{ $offer->description }}</p>
                                    <p class="text-sm text-gray-600">Published by: {{ $offer->entreprise->name }}
                                    </p>
                                    <p class="text-sm text-gray-600">Email: {{ $offer->entreprise->email }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>




    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Publier un Offre d'emploi
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="POST" action="{{ route('jobs.store') }}">
                    @csrf

                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="nom"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" name="nom" id="nom"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Entrer le nom d'emploi" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="titre"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre</label>
                            <input type="text" name="titre" id="titre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Entrer le titre d'emploi" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Description</label>
                            <textarea id="description" rows="4" name="description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Entrer description d'emploi ici"></textarea>
                        </div>
                        <div class="col-span-2">
                            <label for="competences"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Competences</label>
                            <div class="relative" style="position: relative;">
                                <input type="text" name="competences[]" id="competences"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm mb-2 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-80 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Entrer le competences d'emploi" required="">
                                <div class="bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center absolute top-0 right-0 cursor-pointer"
                                    onclick="addInput()">
                                    <svg class="text-gray-600 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>


                        <div class="col-span-2 sm:col-span-1">
                            <label for=""
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type de
                                contrat</label>
                            <select id="" name="type_contrat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm w-[375px] rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected disabled>Select type</option>
                                <option value="a distance">à distance</option>
                                <option value="hybride">hybride</option>
                                <option value="a temps plein">à temps plein</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="emplacement"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Emplacement</label>
                            <input type="text" name="emplacement" id="emplacement"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Entrer le emplacement d'emploi" required="">
                        </div>

                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-purple-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                        Publier
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function addInput() {
            var newInput = document.createElement("input");
            newInput.type = "text";
            newInput.name = "competences[]"; 
            newInput.className =
                "bg-gray-50 border border-gray-300 text-gray-900 text-sm  mb-2 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-80 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500";
            newInput.placeholder = "Entrer le competences d'emploi";
            document.getElementById("competences").parentNode.appendChild(newInput);
        }
    </script>


</x-app-layout>
