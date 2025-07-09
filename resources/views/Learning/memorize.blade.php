<x-app-layout>
    <div class= "mt-5 h-[880px]">
        <div class="w-9/10 md:w-4/5 mx-auto sm:px-6 lg:px-8 h-full">
            <div class="min-h-screen bg-gray-100 dark:bg-gray-800 py-6 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <a href="{{ route('learn.fileList', $fileName) }}" class="ml-auto bg-blue-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-blue-600 transition">
                        Back to word Lists
                    </a>
                    {{-- タイトル --}}
                    <div class="text-center border-gray-300 pb-4">
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100 justify-center items-center">
                                Memorize word lists
                            </h1>
                        </div>
                    </div>
                    {{-- content --}}
                    @php
                        $count = count($wordSet);
                    @endphp
                    <div class="overflow-x-auto">
                        <button type="button" id="startStudy" class="block mt-4 mb-4 mx-auto bg-green-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-green-600 transition">
                            Start
                        </button>
                        <div class="flex justify-center justify-items-center w-4/5 mx-auto">
                            <div id="original" class="opacity-0 w-full">
                                <div class="w-full h-[150px] bg-orange-500">
                                    <h1 class="text-center pr-2 font-bold text-white">English</h1>
                                    <p class="output my-auto text-center text-white">{{ $wordSet[0][0] }}</p>
                                </div>
                                <button type="button" id="answer" class="block mt-4 mb-4 mx-auto bg-green-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-green-600 transition">
                                    Answer
                                </button>
                            </div>
                            <div id="translated" class="opacity-0 transition-all translate-x-5 duration-700 w-full">
                                <div class="w-full h-[150px] bg-orange-500 opacity-75">
                                    <h1 class="text-center pr-2 font-bold text-white">Japanese</h1>
                                    <p class="output my-auto text-center text-white">{{ $wordSet[0][1] }}</p>
                                </div>
                                <button type="button" id="next" class="block mt-4 mb-4 mx-auto bg-green-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-green-600 transition">
                                    Next
                                </button>
                            </div>
                        </div>
                        <p id="counter" class="opacity-0 mx-auto text-center">Counter: 1 / {{ $count }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let counter = 0;
        const wordSet = @json($wordSet);
        const count = wordSet.length;

        document.getElementById('startStudy').addEventListener('click', function(){
            const original = document.getElementById('original');
            const totalCounter = document.getElementById('counter');
            original.classList.remove('opacity-0');
            totalCounter.classList.remove('opacity-0');
        });
        document.getElementById('answer').addEventListener('click', function(){
            const translated = document.getElementById('translated');
            translated.classList.remove('opacity-0', 'translate-x-5');
        });
        document.getElementById('next').addEventListener('click', function(){
            const original = document.getElementById('original');
            const translated = document.getElementById('translated');
            const totalCounter = document.getElementById('counter');

            if (counter + 1 == count) {
                counter = 0;
            }else{
                counter = counter + 1;
            }

            original.querySelector('.output').textContent = wordSet[counter][0];
            translated.querySelector('.output').textContent = wordSet[counter][1];
            translated.classList.add('opacity-0', 'translate-x-5');
            totalCounter.textContent = `Counter: ${counter+1} / ${count}`;
        });
    </script>
</x-app-layout>
