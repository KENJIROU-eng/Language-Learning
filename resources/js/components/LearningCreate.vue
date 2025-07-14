<template>
    <div class= "mt-5 h-[880px]">
        <div class="w-9/10 md:w-4/5 mx-auto sm:px-6 lg:px-8 h-full">
            <div class="min-h-screen bg-gray-100 dark:bg-gray-800 py-6 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="flex">
                        <router-link to="/vue/learn/fileList" class="ml-auto bg-orange-500 text-white text-lg font-bold px-6 py-2 rounded-md hover:bg-orange-600 transition">
                            Go to file Lists
                        </router-link>
                    </div>
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
                    <div class="overflow-x-auto">
                        <div class="flex justify-center w-full gap-4">
                            <div class="flex-row">
                                <textarea v-model="inputWords"></textarea>
                                <button @click.prevent="submitTranslate" class="bg-green-500 text-center block text-white mx-auto px-2 py-2 rounded-md hover:bg-green-600 transition">Translation</button>
                            </div>
                            <div class="flex-row">
                                <textarea v-model="translatedText"></textarea>
                                <button @click.prevent="editTranslate" class="bg-green-500 text-center block text-white mx-auto px-2 py-2 rounded-md hover:bg-green-600 transition">Edit</button>
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
                                <p class="text-center text-white">{{ copyOriginal }}</p>
                            </div>
                            <div class="w-full h-[150px] bg-orange-500 opacity-75">
                                <h1 class="text-center pr-2 font-bold text-white">Japanese</h1>
                                <p class="text-center text-white">{{ copyTranslated }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from '../bootstrap.js';

const inputWords = ref('');
const translatedText = ref('');
const copyOriginal = ref('');
const copyTranslated = ref('');

const submitTranslate = async () => {
    try {
        const formData = new FormData();
        //name の指定
        formData.append('words', inputWords.value);

        const res = await axios.post('/api/vue/learn/translate', formData);
        translatedText.value = res.data.translated;
        copyOriginal.value = res.data.storedOriginal;
        copyTranslated.value = res.data.storedTranslated;
    } catch (error) {
        translatedText.value = '翻訳に失敗しました';
    }
};

const editTranslate = async () => {
    try {
        const res = await axios.patch('/api/vue/learn/update', {
            translatedText: translatedText.value
        });
        translatedText.value = res.data.editTranslated;
        copyTranslated.value = res.data.editTranslated;
    } catch (error) {
        translatedText.value = '編集に失敗しました';
    }
};
</script>
