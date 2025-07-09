<x-app-layout>
    <div class= "mt-5 h-[880px]">
        <div class="w-9/10 md:w-4/5 mx-auto sm:px-6 lg:px-8 h-full">
            <div class="min-h-screen bg-gray-100 dark:bg-gray-800 py-6 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="flex">
                        <a href="{{ route('learn.fileList') }}" class="ml-auto bg-orange-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-orange-600 transition">
                            Go to file Lists
                        </a>
                    </div>
                    {{-- タイトル --}}
                    <div class="text-center border-gray-300 pb-4">
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100 justify-center items-center">
                                Create New word-List
                            </h1>
                        </div>
                        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-100 border-b pb-2">
                            Search and Create
                        </h2>
                    </div>
                    {{-- content --}}
                    <div class="overflow-x-auto">
                        <div class="flex justify-center w-full gap-4">
                            <div class="flex-row">
                                <form action="{{ route('learn.translate') }}" method="post" id="translateForm">
                                    @csrf
                                    <div class="flex justify-center mt-6 gap-10">
                                        <p class="text-lg px-6 py-2">New Words/Sentences</p>
                                        <button type="submit" class="bg-green-500 text-white text-lg font-bold px-6 rounded-md hover:bg-green-600 transition">
                                            submit
                                        </button>
                                    </div>
                                    <div class="mt-3">
                                        <textarea name="words" id="words" cols="50" rows="5"></textarea>
                                    </div>
                                    @error('words')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </form>
                            </div>
                            <div class="flex-row">
                                <form action="{{ route('learn.update') }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex justify-center mt-6 gap-4">
                                        <p class="text-lg px-6 py-2">Translation Results</p>
                                        <button type="submit" class="bg-green-500 text-white text-lg font-bold px-6 rounded-md hover:bg-green-600 transition">
                                            Edit
                                        </button>
                                    </div>
                                    <div class="mt-3">
                                        <textarea name="translatedText" id="translatedText" cols="50" rows="5"></textarea>
                                    </div>
                                    @error('translatedText')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-100 mb-6 border-b pb-2">
                            NewWords List
                        </h2>

                        <div class="flex justify-center justify-items-center w-4/5 mx-auto">
                            <div class="w-full h-[150px] bg-orange-500">
                                <h1 class="text-center pr-2 font-bold text-white">English</h1>
                                <p id="copyOriginal" class="my-auto text-center"></p>
                            </div>
                            <div class="w-full h-[150px] bg-orange-500 opacity-75">
                                <h1 class="text-center pr-2 font-bold text-white">Japanese</h1>
                                <p id="copyTranslated" class="my-auto text-center"></p>
                            </div>
                        </div>
                        @php

                        @endphp

                        <div class="space-y-4 mt-2 max-h-[300px] overflow-y-auto">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('translateForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('translatedText').value = data.translated;
                document.getElementById('copyOriginal').textContent = data.storedOriginal;
                document.getElementById('copyTranslated').textContent = data.storedTranslated;
            })
            .catch(error => {
                document.getElementById('translatedText').value = '翻訳に失敗しました';
            });
        });
    </script>
</x-app-layout>
