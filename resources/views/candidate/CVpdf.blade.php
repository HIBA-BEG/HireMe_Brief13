<x-app-layout>
    <div class="flex justify-center" >
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
                <h2 class="text-2xl font-bold mb-4 flex justify-center text-purple-600 underline">Your CV</h2>
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
    </div>
    </x-app-layout>
    