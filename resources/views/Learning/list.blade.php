<x-app-layout>
    <div class= "mt-5 h-[880px]">
        <div class="w-9/10 md:w-4/5 mx-auto sm:px-6 lg:px-8 h-full">
            <div class="min-h-screen bg-gray-100 dark:bg-gray-800 py-6 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <a href="{{ route('learn.fileList') }}" class="bg-blue-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-blue-600 transition">
                        Back to file Lists
                    </a>
                    {{-- タイトル --}}
                    <div class="relative text-center border-gray-300 pb-4">
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100 flex justify-center items-center">
                                word-Lists
                            </h1>
                        </div>
                    </div>
                    {{-- content --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200 border border-gray-300">
                            <thead class="bg-gray-200 dark:bg-gray-700 text-xs uppercase tracking-wider">
                                <tr>
                                    <th class="px-4 py-2">File (Date)</th>
                                    <th class="px-4 py-2">Japanese Words</th>
                                    <th class="px-4 py-2">English Words</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_words as $word)
                                    <tr class="border-t border-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800">
                                        <td class="px-4 py-3">
                                            {{ $word->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $word->originalText }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $word->translatedText }}
                                        </td>
                                        <td class="px-4 py-3">

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
